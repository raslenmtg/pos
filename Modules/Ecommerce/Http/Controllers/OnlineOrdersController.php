<?php

namespace Modules\Ecommerce\Http\Controllers;

use App\Business;
use App\Contact;
use App\Transaction;
use App\TransactionSellLine;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OnlineOrdersController extends Controller
{
    protected $transactionUtil;

    public function __construct(Util $transactionUtil)
    {
        $this->transactionUtil = $transactionUtil;
    }

    public function index(Request $request)
    {
        $business_id = $request->session()->get('user.business_id');

        if ($request->ajax()) {
            $orders = Transaction::where('transactions.business_id', $business_id)
                ->where('transactions.type', 'sell')
                ->where('transactions.status', 'online')
                ->leftJoin('contacts', 'transactions.contact_id', '=', 'contacts.id')
                ->select([
                    'transactions.id',
                    'transactions.ref_no',
                    'transactions.final_total',
                    'transactions.shipping_status',
                    'transactions.additional_notes',
                    'transactions.created_at',
                    'contacts.name as contact_name',
                    'contacts.mobile as contact_phone',
                ])
                ->latest('transactions.created_at');

            return DataTables::of($orders)
                ->addColumn('customer', function ($row) {
                    $info = json_decode($row->additional_notes, true) ?? [];
                    $name  = $info['customer_name']  ?? $row->contact_name ?? '—';
                    $phone = $info['customer_phone'] ?? $row->contact_phone ?? '—';
                    $addr  = $info['customer_address'] ?? '';
                    return "<strong>{$name}</strong><br><small>{$phone}</small><br><small class='text-muted'>{$addr}</small>";
                })
                ->addColumn('total', function ($row) {
                    return number_format($row->final_total, 2).' DT';
                })
                ->addColumn('shipping', function ($row) {
                    $statuses = $this->transactionUtil->shipping_statuses();
                    $label = $statuses[$row->shipping_status] ?? '<em class="text-muted">Non défini</em>';
                    $colors = ['ordered' => 'info', 'packed' => 'warning', 'shipped' => 'primary', 'delivered' => 'success', 'cancelled' => 'danger'];
                    $color = $colors[$row->shipping_status] ?? 'default';
                    return $row->shipping_status
                        ? "<span class='label label-{$color}'>{$label}</span>"
                        : '<em class="text-muted">—</em>';
                })
                ->addColumn('date', function ($row) {
                    return $row->created_at ? $row->created_at->format('d/m/Y H:i') : '—';
                })
                ->addColumn('actions', function ($row) {
                    return '<button class="btn btn-xs btn-info btn-show-order" data-id="'.$row->id.'"><i class="fa fa-eye"></i> Voir</button> '
                        .'<button class="btn btn-xs btn-success btn-finalize-order" data-id="'.$row->id.'"><i class="fa fa-check"></i> Finaliser</button>';
                })
                ->rawColumns(['customer', 'shipping', 'actions'])
                ->make(true);
        }

        $shipping_statuses = $this->transactionUtil->shipping_statuses();

        return view('ecommerce::orders.index', compact('shipping_statuses'));
    }

    public function show(Request $request, $id)
    {
        $business_id = $request->session()->get('user.business_id');

        $transaction = Transaction::where('business_id', $business_id)
            ->where('status', 'online')
            ->with(['sell_lines.product', 'sell_lines.variations'])
            ->findOrFail($id);

        $contact = Contact::find($transaction->contact_id);
        $info = json_decode($transaction->additional_notes, true) ?? [];
        $shipping_statuses = $this->transactionUtil->shipping_statuses();

        return view('ecommerce::orders.show_modal', compact('transaction', 'contact', 'info', 'shipping_statuses'));
    }

    public function finalize(Request $request, $id)
    {
        $business_id = $request->session()->get('user.business_id');

        $transaction = Transaction::where('business_id', $business_id)
            ->where('status', 'online')
            ->findOrFail($id);

        $info = json_decode($transaction->additional_notes, true) ?? [];

        DB::beginTransaction();
        try {
            if ($transaction->contact_id) {
                $contact = Contact::find($transaction->contact_id);
                if ($contact && empty($contact->name)) {
                    $contact->update([
                        'name'          => $info['customer_name'] ?? $contact->name,
                        'address_line_1' => $info['customer_address'] ?? $contact->address_line_1,
                    ]);
                }
            }

            $shipping_status = $request->input('shipping_status', 'ordered');
            $transaction->update([
                'status'          => 'final',
                'shipping_status' => $shipping_status,
            ]);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Commande finalisée avec succès.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
