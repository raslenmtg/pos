<?php

namespace Modules\Ecommerce\Http\Controllers;

use App\Business;
use App\Contact;
use App\Product;
use App\Transaction;
use App\TransactionSellLine;
use App\Variation;
use App\BusinessLocation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class OnlineStoreController extends Controller
{
    protected function resolveBusiness($subdomain)
    {
        return Business::where('online_store_subdomain', $subdomain)->firstOrFail();
    }

    protected function cartKey($business_id)
    {
        return 'ecom_cart_'.$business_id;
    }

    public function index(Request $request, $subdomain)
    {
        $business = $this->resolveBusiness($subdomain);

        $query = Product::where('business_id', $business->id)
            ->where('online_store_enabled', true)
            ->where('not_for_selling', 0)
            ->with(['variations']);

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($sq) use ($q) {
                $sq->where('name', 'like', "%{$q}%")
                   ->orWhere('sku', 'like', "%{$q}%");
            });
        }

        $products = $query->paginate(12)->appends($request->query());

        $cart = session($this->cartKey($business->id), []);
        $cart_count = array_sum(array_column($cart, 'quantity'));

        return view('ecommerce::store.index', compact('business', 'products', 'cart_count', 'subdomain'));
    }

    public function show(Request $request, $subdomain, $id)
    {
        $business = $this->resolveBusiness($subdomain);

        $product = Product::where('business_id', $business->id)
            ->where('online_store_enabled', true)
            ->where('not_for_selling', 0)
            ->with(['variations'])
            ->findOrFail($id);

        $cart = session($this->cartKey($business->id), []);
        $cart_count = array_sum(array_column($cart, 'quantity'));

        return view('ecommerce::store.show', compact('business', 'product', 'cart_count', 'subdomain'));
    }

    public function cart(Request $request, $subdomain)
    {
        $business = $this->resolveBusiness($subdomain);
        $cart = session($this->cartKey($business->id), []);

        $items = [];
        foreach ($cart as $key => $item) {
            $variation = Variation::with('product')->find($item['variation_id']);
            if ($variation) {
                $items[] = [
                    'key'        => $key,
                    'variation'  => $variation,
                    'product'    => $variation->product,
                    'quantity'   => $item['quantity'],
                    'price'      => $variation->sell_price_inc_tax,
                    'subtotal'   => $variation->sell_price_inc_tax * $item['quantity'],
                ];
            }
        }

        $total = array_sum(array_column($items, 'subtotal'));
        $cart_count = array_sum(array_column($cart, 'quantity'));

        return view('ecommerce::store.cart', compact('business', 'items', 'total', 'cart_count', 'subdomain'));
    }

    public function addToCart(Request $request, $subdomain)
    {
        $business = $this->resolveBusiness($subdomain);
        $variation_id = $request->input('variation_id');
        $quantity = max(1, (int) $request->input('quantity', 1));

        $variation = Variation::findOrFail($variation_id);

        $key = 'v_'.$variation_id;
        $cart = session($this->cartKey($business->id), []);
        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $quantity;
        } else {
            $cart[$key] = ['variation_id' => $variation_id, 'quantity' => $quantity];
        }
        session([$this->cartKey($business->id) => $cart]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'cart_count' => array_sum(array_column($cart, 'quantity'))]);
        }

        return redirect()->back()->with('success', 'Produit ajouté au panier.');
    }

    public function removeFromCart(Request $request, $subdomain)
    {
        $business = $this->resolveBusiness($subdomain);
        $key = $request->input('key');
        $cart = session($this->cartKey($business->id), []);
        unset($cart[$key]);
        session([$this->cartKey($business->id) => $cart]);

        return redirect()->back()->with('success', 'Article supprimé.');
    }

    public function updateCart(Request $request, $subdomain)
    {
        $business = $this->resolveBusiness($subdomain);
        $key = $request->input('key');
        $quantity = max(1, (int) $request->input('quantity', 1));
        $cart = session($this->cartKey($business->id), []);
        if (isset($cart[$key])) {
            $cart[$key]['quantity'] = $quantity;
        }
        session([$this->cartKey($business->id) => $cart]);

        return redirect()->back();
    }

    public function checkout(Request $request, $subdomain)
    {
        $business = $this->resolveBusiness($subdomain);
        $cart = session($this->cartKey($business->id), []);

        if (empty($cart)) {
            return redirect()->route('ecom.dev.cart', $subdomain)->with('error', 'Votre panier est vide.');
        }

        $items = [];
        foreach ($cart as $key => $item) {
            $variation = Variation::with('product')->find($item['variation_id']);
            if ($variation) {
                $items[] = [
                    'key'       => $key,
                    'variation' => $variation,
                    'product'   => $variation->product,
                    'quantity'  => $item['quantity'],
                    'price'     => $variation->sell_price_inc_tax,
                    'subtotal'  => $variation->sell_price_inc_tax * $item['quantity'],
                ];
            }
        }

        $total = array_sum(array_column($items, 'subtotal'));
        $cart_count = array_sum(array_column($cart, 'quantity'));

        return view('ecommerce::store.checkout', compact('business', 'items', 'total', 'cart_count', 'subdomain'));
    }

    public function placeOrder(Request $request, $subdomain)
    {
        $business = $this->resolveBusiness($subdomain);
        $cart = session($this->cartKey($business->id), []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Votre panier est vide.');
        }

        $request->validate([
            'customer_name'  => 'required|string|max:191',
            'customer_phone' => 'required|string|max:30',
            'customer_address' => 'required|string|max:500',
        ]);

        DB::beginTransaction();
        try {
            $location = BusinessLocation::where('business_id', $business->id)->first();
            $admin = User::where('business_id', $business->id)->orderBy('id')->first();

            if (! $location || ! $admin) {
                return redirect()->back()->with('error', 'Configuration du magasin incomplète. Veuillez contacter le support.');
            }

            $contact = Contact::firstOrCreate(
                ['mobile' => $request->customer_phone, 'business_id' => $business->id],
                [
                    'name'         => $request->customer_name,
                    'type'         => 'customer',
                    'address_line_1' => $request->customer_address,
                    'created_by'   => $admin->id,
                ]
            );

            $subtotal = 0;
            $sell_lines = [];
            foreach ($cart as $item) {
                $variation = Variation::find($item['variation_id']);
                if (! $variation) continue;

                $price = $variation->sell_price_inc_tax;
                $qty   = $item['quantity'];
                $subtotal += $price * $qty;

                $sell_lines[] = [
                    'product_id'         => $variation->product_id,
                    'variation_id'       => $variation->id,
                    'quantity'           => $qty,
                    'unit_price'         => $price,
                    'unit_price_inc_tax' => $price,
                    'item_tax'           => 0,
                    'line_discount_amount' => 0,
                    'unit_price_before_discount' => $price,
                    'children_type'      => '',
                ];
            }

            $ref_no = 'ONLINE-'.strtoupper(substr(uniqid(),-5));

            $transaction = Transaction::create([
                'business_id'     => $business->id,
                'location_id'     => $location->id,
                'type'            => 'sell',
                'status'          => 'online',
                'payment_status'  => 'due',
                'contact_id'      => $contact->id,
                'transaction_date' => now(),
                'total_before_tax' => $subtotal,
                'tax_amount'      => 0,
                'discount_amount' => 0,
                'shipping_charges' => 0,
                'final_total'     => $subtotal,
                'created_by'      => $admin->id,
                'ref_no'          => $ref_no,
                'additional_notes' => json_encode([
                    'customer_name'    => $request->customer_name,
                    'customer_phone'   => $request->customer_phone,
                    'customer_address' => $request->customer_address,
                ]),
            ]);

            foreach ($sell_lines as $line) {
                $line['transaction_id'] = $transaction->id;
                TransactionSellLine::create($line);
            }

            session()->forget($this->cartKey($business->id));
            DB::commit();

            return redirect()->route('ecom.dev.success', [$subdomain, $ref_no]);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Une erreur est survenue: '.$e->getMessage());
        }
    }

    public function success(Request $request, $subdomain, $ref)
    {
        $business = $this->resolveBusiness($subdomain);
        $transaction = Transaction::where('business_id', $business->id)
            ->where('ref_no', $ref)
            ->firstOrFail();

        return view('ecommerce::store.success', compact('business', 'transaction', 'subdomain'));
    }
}
