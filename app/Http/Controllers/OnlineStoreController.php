<?php

namespace App\Http\Controllers;

use App\Business;
use App\OnlineOrder;
use App\Product;
use App\Utils\ProductUtil;
use Illuminate\Http\Request;

class OnlineStoreController extends Controller
{
    protected $productUtil;

    public function __construct(ProductUtil $productUtil)
    {
        $this->productUtil = $productUtil;
    }

    protected function getBusinessBySlug($slug)
    {
        return Business::where('ecom_slug', $slug)->firstOrFail();
    }

    public function index($slug)
    {
        $business = $this->getBusinessBySlug($slug);

        $query = Product::where('business_id', $business->id)
            ->where('sell_online', true)
            ->where('not_for_selling', false)
            ->with(['product_variations.variations' => function ($q) {
                $q->select('id', 'product_variation_id', 'name', 'sub_sku', 'default_sell_price', 'sell_price_inc_tax');
            }]);

        if (request('category')) {
            $query->where('category_id', request('category'));
        }
        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        $products = $query->select('id', 'name', 'image', 'product_description', 'category_id', 'type')
            ->orderBy('name')
            ->paginate(16);

        $categories = \App\Category::where('business_id', $business->id)
            ->whereNull('parent_id')
            ->pluck('name', 'id');

        return view('online_store.index', compact('business', 'products', 'categories', 'slug'));
    }

    public function show($slug, $id)
    {
        $business = $this->getBusinessBySlug($slug);

        $product = Product::where('business_id', $business->id)
            ->where('sell_online', true)
            ->with(['product_variations.variations'])
            ->findOrFail($id);

        return view('online_store.show', compact('business', 'product', 'slug'));
    }

    public function cart($slug)
    {
        $business = $this->getBusinessBySlug($slug);
        $cart = session('online_cart_' . $business->id, []);

        $cartItems = [];
        foreach ($cart as $variation_id => $qty) {
            $variation = \App\Variation::find($variation_id);
            if ($variation) {
                $product = Product::find($variation->product_id);
                $cartItems[] = [
                    'variation_id' => $variation_id,
                    'name'         => $product->name . ($variation->name !== 'default' ? ' - ' . $variation->name : ''),
                    'price'        => $variation->sell_price_inc_tax,
                    'qty'          => $qty,
                    'image'        => $product->image_url,
                    'product_id'   => $product->id,
                ];
            }
        }

        return view('online_store.cart', compact('business', 'cartItems', 'slug'));
    }

    public function addToCart(Request $request, $slug)
    {
        $business = $this->getBusinessBySlug($slug);
        $variation_id = $request->input('variation_id');
        $qty = max(1, (int) $request->input('qty', 1));

        $variation = \App\Variation::find($variation_id);
        if (!$variation) {
            return back()->with('error', 'Produit introuvable.');
        }

        $key = 'online_cart_' . $business->id;
        $cart = session($key, []);
        $cart[$variation_id] = ($cart[$variation_id] ?? 0) + $qty;
        session([$key => $cart]);

        return redirect()->route('online_store.cart', $slug)->with('success', 'Produit ajouté au panier.');
    }

    public function removeFromCart(Request $request, $slug)
    {
        $business = $this->getBusinessBySlug($slug);
        $variation_id = $request->input('variation_id');

        $key = 'online_cart_' . $business->id;
        $cart = session($key, []);
        unset($cart[$variation_id]);
        session([$key => $cart]);

        return back()->with('success', 'Article supprimé.');
    }

    public function updateCart(Request $request, $slug)
    {
        $business = $this->getBusinessBySlug($slug);
        $key = 'online_cart_' . $business->id;
        $cart = session($key, []);

        foreach ($request->input('quantities', []) as $variation_id => $qty) {
            if ((int) $qty <= 0) {
                unset($cart[$variation_id]);
            } else {
                $cart[$variation_id] = (int) $qty;
            }
        }
        session([$key => $cart]);

        return back()->with('success', 'Panier mis à jour.');
    }

    public function checkout($slug)
    {
        $business = $this->getBusinessBySlug($slug);
        $cart = session('online_cart_' . $business->id, []);

        if (empty($cart)) {
            return redirect()->route('online_store.index', $slug)->with('error', 'Votre panier est vide.');
        }

        $cartItems = $this->resolveCartItems($cart);

        return view('online_store.checkout', compact('business', 'cartItems', 'slug'));
    }

    public function placeOrder(Request $request, $slug)
    {
        $business = $this->getBusinessBySlug($slug);

        $request->validate([
            'customer_name'    => 'required|string|max:191',
            'customer_phone'   => 'required|string|max:30',
            'customer_address' => 'required|string|max:500',
            'customer_city'    => 'nullable|string|max:100',
            'customer_notes'   => 'nullable|string|max:1000',
        ]);

        $cart = session('online_cart_' . $business->id, []);
        if (empty($cart)) {
            return back()->with('error', 'Votre panier est vide.');
        }

        $cartItems = $this->resolveCartItems($cart);
        $subtotal = collect($cartItems)->sum(fn($i) => $i['price'] * $i['qty']);

        $order = OnlineOrder::create([
            'business_id'      => $business->id,
            'order_number'     => OnlineOrder::generateOrderNumber($business->id),
            'customer_name'    => $request->customer_name,
            'customer_phone'   => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'customer_city'    => $request->customer_city,
            'customer_notes'   => $request->customer_notes,
            'items'            => $cartItems,
            'subtotal'         => $subtotal,
            'status'           => 'new',
            'shipping_status'  => 'ordered',
        ]);

        session()->forget('online_cart_' . $business->id);

        return redirect()->route('online_store.success', [$slug, $order->order_number]);
    }

    public function success($slug, $order_number)
    {
        $business = $this->getBusinessBySlug($slug);
        $order = OnlineOrder::where('business_id', $business->id)
            ->where('order_number', $order_number)
            ->firstOrFail();

        return view('online_store.success', compact('business', 'order', 'slug'));
    }

    private function resolveCartItems(array $cart): array
    {
        $items = [];
        foreach ($cart as $variation_id => $qty) {
            $variation = \App\Variation::find($variation_id);
            if ($variation) {
                $product = Product::find($variation->product_id);
                $items[] = [
                    'variation_id' => $variation_id,
                    'product_id'   => $product->id,
                    'name'         => $product->name . ($variation->name !== 'default' ? ' - ' . $variation->name : ''),
                    'sku'          => $variation->sub_sku,
                    'price'        => (float) $variation->sell_price_inc_tax,
                    'qty'          => (int) $qty,
                    'image'        => $product->image_url,
                ];
            }
        }
        return $items;
    }
}
