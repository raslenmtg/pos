<?php

namespace App\Http\Controllers;

use App\Business;
use App\Contact;
use App\OnlineOrder;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class EcomOrderController extends Controller
{
    protected $util;

    public function __construct(Util $util)
    {
        $this->util = $util;
    }

    public function index(Request $request)
    {
        $business_id = $request->session()->get('user.business_id');

        if ($request->ajax()) {
            $orders = OnlineOrder::where('business_id', $business_id)
                ->select('*')
                ->orderBy('created_at', 'desc');

            return DataTables::of($orders)
                ->addColumn('action', function ($row) {
                    $html = '<div class="btn-group">';
                    $html .= '<button type="button" class="btn btn-xs btn-primary btn-modal"
                        data-href="' . action([\App\Http\Controllers\EcomOrderController::class, 'show'], $row->id) . '"
                        data-container=".view_modal">
                        <i class="fa fa-eye"></i> Voir
                    </button>';
                    $html .= '</div>';
                    return $html;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y H:i');
                })
                ->editColumn('status', function ($row) {
                    return $row->status_label;
                })
                ->editColumn('shipping_status', function ($row) {
                    return $row->shipping_status_label;
                })
                ->editColumn('subtotal', function ($row) {
                    return number_format($row->subtotal, 3) . ' TND';
                })
                ->rawColumns(['action', 'status', 'shipping_status'])
                ->make(true);
        }

        $business = Business::find($business_id);
        $shipping_statuses = $this->util->shipping_statuses();
        $order_statuses = [
            'new'        => 'Nouvelle',
            'processing' => 'En traitement',
            'completed'  => 'Complétée',
            'cancelled'  => 'Annulée',
        ];

        return view('ecom.orders.index', compact('business', 'shipping_statuses', 'order_statuses'));
    }

    public function show($id)
    {
        $business_id = request()->session()->get('user.business_id');
        $order = OnlineOrder::where('business_id', $business_id)->findOrFail($id);
        $shipping_statuses = $this->util->shipping_statuses();
        $order_statuses = [
            'new'        => 'Nouvelle',
            'processing' => 'En traitement',
            'completed'  => 'Complétée',
            'cancelled'  => 'Annulée',
        ];

        return view('ecom.orders.show', compact('order', 'shipping_statuses', 'order_statuses'));
    }

    public function updateStatus(Request $request, $id)
    {
        $business_id = $request->session()->get('user.business_id');
        $order = OnlineOrder::where('business_id', $business_id)->findOrFail($id);

        $order->update([
            'status'          => $request->input('status', $order->status),
            'shipping_status' => $request->input('shipping_status', $order->shipping_status),
        ]);

        return response()->json(['success' => true, 'msg' => 'Statut mis à jour.']);
    }

    public function createContact(Request $request, $id)
    {
        $business_id = $request->session()->get('user.business_id');
        $order = OnlineOrder::where('business_id', $business_id)->findOrFail($id);

        if ($order->contact_id) {
            return response()->json(['success' => false, 'msg' => 'Un client existe déjà pour cette commande.']);
        }

        try {
            DB::beginTransaction();

            $existing = Contact::where('business_id', $business_id)
                ->where('mobile', $order->customer_phone)
                ->where('type', 'customer')
                ->first();

            if ($existing) {
                $order->contact_id = $existing->id;
                $order->save();
                DB::commit();
                return response()->json(['success' => true, 'msg' => 'Client existant associé : ' . $existing->name]);
            }

            $contact = Contact::create([
                'business_id' => $business_id,
                'type'        => 'customer',
                'name'        => $order->customer_name,
                'mobile'      => $order->customer_phone,
                'address_line_1' => $order->customer_address,
                'city'        => $order->customer_city,
                'created_by'  => $request->session()->get('user.id'),
            ]);

            $order->contact_id = $contact->id;
            $order->save();

            DB::commit();
            return response()->json(['success' => true, 'msg' => 'Client créé avec succès.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
}
