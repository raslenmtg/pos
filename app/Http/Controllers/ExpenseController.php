<?php

namespace App\Http\Controllers;

use App\Account;
use App\AccountTransaction;
use App\BusinessLocation;
use App\Contact;
use App\Events\ExpenseCreatedOrModified;
use App\ExpenseCategory;
use App\TaxRate;
use App\Transaction;
use App\User;
use App\Utils\CashRegisterUtil;
use App\Utils\ModuleUtil;
use App\Utils\TransactionUtil;
use DB;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ExpenseController extends Controller
{
    /**
     * Constructor
     *
     * @param  TransactionUtil  $transactionUtil
     * @return void
     */
    public function __construct(TransactionUtil $transactionUtil, ModuleUtil $moduleUtil, CashRegisterUtil $cashRegisterUtil)
    {
        $this->transactionUtil = $transactionUtil;
        $this->moduleUtil = $moduleUtil;
        $this->dummyPaymentLine = ['method' => 'cash', 'amount' => 0, 'note' => '', 'card_transaction_number' => '', 'card_number' => '', 'card_type' => '', 'card_holder_name' => '', 'card_month' => '', 'card_year' => '', 'card_security' => '', 'cheque_number' => '', 'bank_account_number' => '',
            'is_return' => 0, 'transaction_no' => '', ];
        $this->cashRegisterUtil = $cashRegisterUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! auth()->user()->can('all_expense.access') && ! auth()->user()->can('view_own_expense')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');

            $expenses = Transaction::leftJoin('expense_categories AS ec', 'transactions.expense_category_id', '=', 'ec.id')
                        ->leftJoin('expense_categories AS esc', 'transactions.expense_sub_category_id', '=', 'esc.id')
                        ->join(
                            'business_locations AS bl',
                            'transactions.location_id',
                            '=',
                            'bl.id'
                        )
                        ->leftJoin('tax_rates as tr', 'transactions.tax_id', '=', 'tr.id')
                        ->leftJoin('users AS U', 'transactions.expense_for', '=', 'U.id')
                        ->leftJoin('users AS usr', 'transactions.created_by', '=', 'usr.id')
                        ->leftJoin('contacts AS c', 'transactions.contact_id', '=', 'c.id')
                        ->leftJoin(
                            'transaction_payments AS TP',
                            'transactions.id',
                            '=',
                            'TP.transaction_id'
                        )
                        ->where('transactions.business_id', $business_id)
                        ->whereIn('transactions.type', ['expense', 'expense_refund'])
                        ->select(
                            'transactions.id',
                            'transactions.contact_id as c_id',
                            'transactions.document',
                            'transaction_date',
                            'ref_no',
                            'ec.name as category',
                            'esc.name as sub_category',
                            'payment_status',
                            'additional_notes',
                            'final_total',
                            'transactions.is_recurring',
                            'transactions.code_rs',
                            'transactions.recur_interval',
                            'transactions.recur_interval_type',
                            'transactions.recur_repetitions',
                            'transactions.subscription_repeat_on',
                            'bl.name as location_name',
                            DB::raw("CONCAT(COALESCE(U.surname, ''),' ',COALESCE(U.first_name, ''),' ',COALESCE(U.last_name,'')) as expense_for"),
                            DB::raw("CONCAT(tr.name ,' (', tr.amount ,' )') as tax"),
                            DB::raw('SUM(TP.amount) as amount_paid'),
                            DB::raw("CONCAT(COALESCE(usr.surname, ''),' ',COALESCE(usr.first_name, ''),' ',COALESCE(usr.last_name,'')) as added_by"),
                            'transactions.recur_parent_id',
                            'c.name as contact_name',
                            'c.contact_id as contact_id', 
                            'c.supplier_business_name as supplier_business_name', 
                            'transactions.type'
                        )
                        ->with(['recurring_parent'])
                        ->groupBy('transactions.id');

            //Add condition for expense for,used in sales representative expense report & list of expense
            if (request()->has('expense_for')) {
                $expense_for = request()->get('expense_for');
                if (! empty($expense_for)) {
                    $expenses->where('transactions.expense_for', $expense_for);
                }
            }

            if (request()->has('contact_id')) {
                $contact_id = request()->get('contact_id');
                if (! empty($contact_id)) {
                    $expenses->where('transactions.contact_id', $contact_id);
                }
            }

            //Add condition for location,used in sales representative expense report & list of expense
            if (request()->has('location_id')) {
                $location_id = request()->get('location_id');
                if (! empty($location_id)) {
                    $expenses->where('transactions.location_id', $location_id);
                }
            }

            //Add condition for expense category, used in list of expense,
            if (request()->has('expense_category_id')) {
                $expense_category_id = request()->get('expense_category_id');
                if (! empty($expense_category_id)) {
                    $expenses->where('transactions.expense_category_id', $expense_category_id);
                }
            }

            //Add condition for expense sub category, used in list of expense,
            if (request()->has('expense_sub_category_id')) {
                $expense_sub_category_id = request()->get('expense_sub_category_id');
                if (! empty($expense_sub_category_id)) {
                    $expenses->where('transactions.expense_sub_category_id', $expense_sub_category_id);
                }
            }

            //Add condition for start and end date filter, uses in sales representative expense report & list of expense
            if (! empty(request()->start_date) && ! empty(request()->end_date)) {
                $start = request()->start_date;
                $end = request()->end_date;
                $expenses->whereDate('transaction_date', '>=', $start)
                        ->whereDate('transaction_date', '<=', $end);
            }

            $permitted_locations = auth()->user()->permitted_locations();
            if ($permitted_locations != 'all') {
                $expenses->whereIn('transactions.location_id', $permitted_locations);
            }

            //Add condition for payment status for the list of expense
            if (request()->has('payment_status')) {
                $payment_status = request()->get('payment_status');
                if (! empty($payment_status)) {
                    $expenses->where('transactions.payment_status', $payment_status);
                }
            }

            $is_admin = $this->moduleUtil->is_admin(auth()->user(), $business_id);
            if (! $is_admin && ! auth()->user()->can('all_expense.access')) {
                $user_id = auth()->user()->id;
                $expenses->where(function ($query) use ($user_id) {
                    $query->where('transactions.created_by', $user_id)
                        ->orWhere('transactions.expense_for', $user_id);
                });
            }

            return Datatables::of($expenses)
                ->addColumn('#','<input type="checkbox" class="row_checkbox" value="{{$id}}">')
                ->addColumn(
                    'action',
                    '<div class="btn-group">
                        <button type="button" class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline  tw-dw-btn-info tw-w-max dropdown-toggle" 
                            data-toggle="dropdown" aria-expanded="false"> @lang("messages.actions")<span class="caret"></span><span class="sr-only">Toggle Dropdown
                                </span>
                        </button>
                    <ul class="dropdown-menu dropdown-menu-left" role="menu">
                    @if(auth()->user()->can("expense.edit"))
                        <li><a href="{{action(\'App\Http\Controllers\ExpenseController@edit\', [$id])}}"><i class="glyphicon glyphicon-edit"></i> @lang("messages.edit")</a></li>
                    @endif
                    @if($document)
                        <li><a href="{{ url(\'uploads/documents/\' . $document)}}" 
                        download=""><i class="fa fa-download" aria-hidden="true"></i> @lang("purchase.download_document")</a></li>
                        @if(isFileImage($document))
                            <li><a href="#" data-href="{{ url(\'uploads/documents/\' . $document)}}" class="view_uploaded_document"><i class="fas fa-file-image" aria-hidden="true"></i>@lang("lang_v1.view_document")</a></li>
                        @endif
                    @endif
                    @if(auth()->user()->can("expense.delete"))
                        <li>
                        <a href="#" data-href="{{action(\'App\Http\Controllers\ExpenseController@destroy\', [$id])}}" class="delete_expense"><i class="glyphicon glyphicon-trash"></i> @lang("messages.delete")</a></li>
                    @endif
                    <li class="divider"></li> 
                    @if($payment_status != "paid")
                        <li><a href="{{action([\App\Http\Controllers\TransactionPaymentController::class, \'addPayment\'], [$id])}}" class="add_payment_modal"><i class="fas fa-money-bill-alt" aria-hidden="true"></i> @lang("purchase.add_payment")</a></li>
                    @endif
                    <li><a href="{{action([\App\Http\Controllers\TransactionPaymentController::class, \'show\'], [$id])}}" class="view_payment_modal"><i class="fas fa-money-bill-alt" aria-hidden="true" ></i> @lang("purchase.view_payments")</a></li>
                    </ul></div>'
                )
                ->removeColumn('id')
                ->editColumn(
                    'final_total',
                    '<span class="display_currency final-total" data-currency_symbol="true" data-orig-value="@if($type=="expense_refund"){{-1 * $final_total}}@else{{$final_total}}@endif">@if($type=="expense_refund") - @endif @format_currency($final_total)</span>'
                )
                ->editColumn(
                    'contact_name',
                    function ($row) {
                        if (!empty($row->c_id)) {
                            return '<span class="">' 
                                . (!empty($row->contact_name) ? $row->contact_name . ' / ' : '')
                                . (!empty($row->contact_id) ? '('. $row->contact_id . ')' : '')
                                . (!empty($row->supplier_business_name) ? '/'. $row->supplier_business_name  : '') . '</span>';
                        }
                        return '';
                    }
                )
                ->editColumn('transaction_date', '{{@format_datetime($transaction_date)}}')
                ->editColumn('code_rs', function ($row){
                        return !empty($row->code_rs)? '<svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
fill="green" viewBox="0 0 24 24" >
<path d="M9 15.59 4.71 11.3 3.3 12.71l5 5c.2.2.45.29.71.29s.51-.1.71-.29l11-11-1.41-1.41L9.02 15.59Z"></path>
</svg>':'';
                })
                ->editColumn(
                    'payment_status',
                    '<a href="{{ action([\App\Http\Controllers\TransactionPaymentController::class, \'show\'], [$id])}}" class="view_payment_modal payment-status" data-orig-value="{{$payment_status}}" data-status-name="{{__(\'lang_v1.\' . $payment_status)}}"><span class="label @payment_status($payment_status)">{{__(\'lang_v1.\' . $payment_status)}}
                        </span></a>'
                )
                ->addColumn('payment_due', function ($row) {
                    $due = $row->final_total - $row->amount_paid;

                    if ($row->type == 'expense_refund') {
                        $due = -1 * $due;
                    }

                    return '<span class="display_currency payment_due" data-currency_symbol="true" data-orig-value="'.$due.'">'.$this->transactionUtil->num_f($due, true).'</span>';
                })
                ->addColumn('recur_details', function ($row) {
                    $details = '<small>';
                    if ($row->is_recurring == 1) {
                        $type = $row->recur_interval == 1 ? Str::singular(__('lang_v1.'.$row->recur_interval_type)) : __('lang_v1.'.$row->recur_interval_type);
                        $recur_interval = $row->recur_interval.$type;

                        $details .= __('lang_v1.recur_interval').': '.$recur_interval;
                        if (! empty($row->recur_repetitions)) {
                            $details .= ', '.__('lang_v1.no_of_repetitions').': '.$row->recur_repetitions;
                        }
                        if ($row->recur_interval_type == 'months' && ! empty($row->subscription_repeat_on)) {
                            $details .= '<br><small class="text-muted">'.
                            __('lang_v1.repeat_on').': '.str_ordinal($row->subscription_repeat_on);
                        }
                    } elseif (! empty($row->recur_parent_id)) {
                        $details .= __('lang_v1.recurred_from').': '.$row->recurring_parent->ref_no;
                    }
                    $details .= '</small>';

                    return $details;
                })
                ->editColumn('ref_no', function ($row) {
                    $ref_no = $row->ref_no;
                    if (! empty($row->is_recurring)) {
                        $ref_no .= ' &nbsp;<small class="label bg-red label-round no-print" title="'.__('lang_v1.recurring_expense').'"><i class="fas fa-recycle"></i></small>';
                    }

                    if (! empty($row->recur_parent_id)) {
                        $ref_no .= ' &nbsp;<small class="label bg-info label-round no-print" title="'.__('lang_v1.generated_recurring_expense').'"><i class="fas fa-recycle"></i></small>';
                    }

                    if ($row->type == 'expense_refund') {
                        $ref_no .= ' &nbsp;<small class="label bg-gray">'.__('lang_v1.refund').'</small>';
                    }

                    return $ref_no;
                })
                ->rawColumns(['#', 'final_total', 'action', 'payment_status', 'contact_name', 'payment_due', 'ref_no', 'recur_details', 'code_rs'])
                ->make(true);
        }

        $business_id = request()->session()->get('user.business_id');

        $categories = ExpenseCategory::where('business_id', $business_id)
                            ->whereNull('parent_id')
                            ->pluck('name', 'id');

        $users = User::forDropdown($business_id, false, true, true);

        $business_locations = BusinessLocation::forDropdown($business_id, true);

        $contacts = Contact::contactDropdown($business_id, false, false);

        $sub_categories = ExpenseCategory::where('business_id', $business_id)
                        ->whereNotNull('parent_id')
                        ->pluck('name', 'id')
                        ->toArray();

        return view('expense.index')
            ->with(compact('categories', 'business_locations', 'users', 'contacts', 'sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! auth()->user()->can('expense.add')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        //Check if subscribed or not
        if (! $this->moduleUtil->isSubscribed($business_id)) {
            return $this->moduleUtil->expiredResponse(action([\App\Http\Controllers\ExpenseController::class, 'index']));
        }

        $business_locations = BusinessLocation::forDropdown($business_id, false, true);

        $bl_attributes = $business_locations['attributes'];
        $business_locations = $business_locations['locations'];

        $expense_categories = ExpenseCategory::where('business_id', $business_id)
                                ->whereNull('parent_id')
                                ->pluck('name', 'id');
        $users = User::forDropdown($business_id, true, true);

        $taxes = TaxRate::forBusinessDropdown($business_id, true, true);

        $payment_line = $this->dummyPaymentLine;

        $payment_types = $this->transactionUtil->payment_types(null, false, $business_id);

        $contacts = Contact::contactDropdown($business_id, false, false);

        // Get full contact details with mobile, address and tax_number for validation
        $contacts_details = Contact::where('business_id', $business_id)
            ->where('type', '!=', 'lead')
            ->where('contact_status', 'active')
            ->select('id', 'mobile', 'address_line_1', 'city', 'state', 'tax_number')
            ->get()
            ->keyBy('id');

        //Accounts
        $accounts = [];
        if ($this->moduleUtil->isModuleEnabled('account')) {
            $accounts = Account::forDropdown($business_id, true, false, true);
        }

        if (request()->ajax()) {
            return view('expense.add_expense_modal')
                ->with(compact('expense_categories', 'business_locations', 'users', 'taxes', 'payment_line', 'payment_types', 'accounts', 'bl_attributes', 'contacts', 'contacts_details'));
        }

        return view('expense.create')
            ->with(compact('expense_categories', 'business_locations', 'users', 'taxes', 'payment_line', 'payment_types', 'accounts', 'bl_attributes', 'contacts', 'contacts_details'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! auth()->user()->can('expense.add')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $business_id = $request->session()->get('user.business_id');

            //Validate document size
            $request->validate([
                'document' => 'file|max:'.(config('constants.document_size_limit') / 1000),
            ]);

            // Validate that if code_rs is provided, contact_id and tax_id must also be provided
            if (!empty($request->input('code_rs'))) {
                $request->validate([
                    'contact_id' => 'required',
                    'tax_id' => 'required',
                ], [
                    'contact_id.required' => __('expense.contact_required_for_rs'),
                    'tax_id.required' => __('expense.tax_required_for_rs'),
                ]);
            }

            $user_id = $request->session()->get('user.id');

            DB::beginTransaction();

            $expense = $this->transactionUtil->createExpense($request, $business_id, $user_id);

            if (request()->ajax()) {
                $payments = ! empty($request->input('payment')) ? $request->input('payment') : [];
                $this->cashRegisterUtil->addSellPayments($expense, $payments);
            }

            $this->transactionUtil->activityLog($expense, 'added');

           // event(new ExpenseCreatedOrModified($expense));

            DB::commit();

            $output = ['success' => 1,
                'msg' => __('expense.expense_add_success'),
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::emergency('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());

            $output = ['success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        if (request()->ajax()) {
            return $output;
        }

        return redirect('expenses')->with('status', $output);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! auth()->user()->can('expense.edit')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        //Check if subscribed or not
        if (! $this->moduleUtil->isSubscribed($business_id)) {
            return $this->moduleUtil->expiredResponse(action([\App\Http\Controllers\ExpenseController::class, 'index']));
        }

        $business_locations = BusinessLocation::forDropdown($business_id);

        $expense_categories = ExpenseCategory::where('business_id', $business_id)
                                ->whereNull('parent_id')
                                ->pluck('name', 'id');
        $expense = Transaction::where('business_id', $business_id)
                                ->where('id', $id)
                                ->first();

        $users = User::forDropdown($business_id, true, true);

        $taxes = TaxRate::forBusinessDropdown($business_id, true, true);

        $contacts = Contact::contactDropdown($business_id, false, false);

        //Sub-category
        $sub_categories = [];

        if (!empty($expense->expense_category_id)) {
            $sub_categories = ExpenseCategory::where('business_id', $business_id)
                ->where('parent_id', $expense->expense_category_id)
                ->pluck('name', 'id')
                ->toArray();
        }

        return view('expense.edit')
            ->with(compact('expense', 'expense_categories', 'business_locations', 'users', 'taxes', 'contacts', 'sub_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('expense.edit')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            //Validate document size
            $request->validate([
                'document' => 'file|max:' . (config('constants.document_size_limit') / 1000),
            ]);

            $business_id = $request->session()->get('user.business_id');

            //Check if subscribed or not
            if (!$this->moduleUtil->isSubscribed($business_id)) {
                return $this->moduleUtil->expiredResponse(action([\App\Http\Controllers\ExpenseController::class, 'index']));
            }

            $expense = $this->transactionUtil->updateExpense($request, $id, $business_id);

            $this->transactionUtil->activityLog($expense, 'edited');

            event(new ExpenseCreatedOrModified($expense));

            $output = ['success' => 1,
                'msg' => __('expense.expense_update_success'),
            ];
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = ['success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        return redirect('expenses')->with('status', $output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('expense.delete')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try {
                $business_id = request()->session()->get('user.business_id');

                $expense = Transaction::where('business_id', $business_id)
                    ->where(function ($q) {
                        $q->where('type', 'expense')
                            ->orWhere('type', 'expense_refund');
                    })
                    ->where('id', $id)
                    ->first();

                //Delete Cash register transactions
                $expense->cash_register_payments()->delete();

                $expense->delete();

                //Delete account transactions
                AccountTransaction::where('transaction_id', $expense->id)->delete();

                event(new ExpenseCreatedOrModified($expense, true));

                $output = ['success' => true,
                    'msg' => __('expense.expense_delete_success'),
                ];
            } catch (\Exception $e) {
                \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

                $output = ['success' => false,
                    'msg' => __('messages.something_went_wrong'),
                ];
            }

            return $output;
        }
    }

    public function importExpense()
    {

        if (!auth()->user()->can('expense.add')) {
            abort(403, 'Unauthorized action.');
        }
        
        $business_id = request()->session()->get('user.business_id');

        $payment_types = $this->transactionUtil->payment_types(null, false, $business_id);
        $zip_loaded = extension_loaded('zip') ? true : false;

        //Check if zip extension it loaded or not.
        if ($zip_loaded === false) {
            $output = ['success' => 0,
                'msg' => 'Please install/enable PHP Zip archive for import',
            ];

            return view('expense.import', compact('payment_types'))
                ->with('notification', $output);
        } else {
            return view('expense.import', compact('payment_types'));
        }
    }

    public function storeExpenseImport(Request $request)
    {

        try {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', -1);

        $business_id = $request->session()->get('user.business_id');
        $user_id = $request->session()->get('user.id');

        if ($request->hasFile('expense_csv')) {
            $file = $request->file('expense_csv');

            $parsed_array = Excel::toArray([], $file);

            $is_valid = true;
            $error_msg = '';

            //Remove header row
            $imported_data = array_splice($parsed_array[0], 1);

            $expense_array = [];
            DB::beginTransaction();

            foreach ($imported_data as $key => $value) {

                $row_no = $key + 1;
                $expense_array['business_id'] = $business_id;
                $expense_array['created_by'] = $user_id;

                if (!empty(trim($value[0]))) {
                    $location_name = trim($value[0]);
                    $location = BusinessLocation::where('name', $location_name)
                        ->where('business_id', $business_id)
                        ->first();
                    if (!empty($location)) {
                        $expense_array['location_id'] = $location->id;
                    } else {
                        $is_valid = false;
                        $error_msg = "No location with name '$location_name' found in row no. $row_no";
                        break;
                    }
                } else {
                    $location = BusinessLocation::where('business_id', $business_id)->first();
                    $expense_array['location_id'] = $location->id;
                }

                //Check if category exists else create new
                $category_name = trim($value[1]);
                if (!empty($category_name)) {
                    $category = ExpenseCategory::where('business_id', $business_id)
                        ->where('name', $category_name)
                        ->first();
                    if (empty($category)) {
                        $category = new ExpenseCategory;
                        $category->business_id = $business_id;
                        $category->name = $category_name;
                        $category->save();
                    }
                    $expense_array['expense_category_id'] = $category->id;
                }

                //  Add Sub-Category
                $sub_category_name = trim($value[2]);

                if (!empty($sub_category_name)) {
                    $sub_category = ExpenseCategory::where('business_id', $business_id)
                        ->where('name', $sub_category_name)
                        ->where('parent_id', $category->id)
                        ->first();
                    if (empty($sub_category)) {
                        $sub_category = new ExpenseCategory;
                        $sub_category->business_id = $business_id;
                        $sub_category->name = $sub_category_name;
                        $sub_category->parent_id = $category->id;
                        $sub_category->save();
                    }
                    $expense_array['expense_sub_category_id'] = $sub_category->id;
                }

                //Update reference count
                $ref_count = $this->transactionUtil->setAndGetReferenceCount('expense', $business_id);
                //Generate reference number
                $ref_no = trim($value[3]);
                if (empty($ref_no)) {
                    $expense_array['ref_no'] = $this->transactionUtil->generateReferenceNumber('expense', $ref_count, $business_id);
                } else {
                    $expense_array['ref_no'] = $ref_no;
                }

                $date = trim($value[4]);

                //check if date is correct
                if (!empty($date)) {
                    try {
                        \Carbon::parse($date);
                    } catch (\Exception $e) {
                        throw new \Exception(__('lang_v1.invalid_date_format_at', ['row' => $row_no]));
                    }
                }

                if (!empty($date)) {
                    $expense_array['transaction_date'] = $date;
                } else {
                    $expense_array['transaction_date'] = \Carbon::now()->toDateTimeString();
                }

                $user_value = trim($value[5]);

                if (!empty($user_value)) {
                    $user = User::where('email', $user_value)->orWhere('username', $user_value)->first();
                    if (!empty($user)) {
                        $expense_array['expense_for'] = $user->id;
                    } else {
                        $is_valid = false;
                        $error_msg = "Invalid user details in row no. $row_no";
                        break;
                    }
                }

                $contact_id = trim($value[6]);

                if (!empty($contact_id)) {

                    $contact = Contact::where('contact_id', $contact_id)->where('business_id', $business_id)->first();
                    if (!empty($contact)) {
                        $expense_array['contact_id'] = $contact->id;
                    } else {
                        $is_valid = false;
                        $error_msg = "Invalid contact id in row no. $row_no";
                        break;
                    }
                }

                $note = trim($value[9]);
                if (!empty($note)) {
                    $expense_array['additional_notes'] = $note;
                }

                $final_total = trim($value[10]);

                if (!empty($final_total)) {
                    $expense_array['final_total'] = $this->transactionUtil->num_uf($final_total);
                } else {
                    $is_valid = false;
                    $error_msg = "Amount not found in row no. $row_no";
                    break;
                }

                $expense_array['total_before_tax'] = $expense_array['final_total'];

                //Add Tax
                $tax_name = trim($value[8]);
                $tax_amount = 0;
                if (!empty($tax_name)) {
                    $tax = TaxRate::where('business_id', $business_id)
                        ->where('name', $tax_name)
                        ->first();
                    if (!empty($tax)) {
                        $expense_array['tax_id'] = $tax->id;
                        $tax_amount = $tax->amount;
                        $expense_array['total_before_tax'] = $this->transactionUtil->calc_percentage_base($expense_array['final_total'], $tax_amount);
                        $expense_array['tax_amount'] = $expense_array['final_total'] - $expense_array['total_before_tax'];
                    }

                    //image name
                    $image_name = trim($value[7]);

                    if (!empty($image_name)) {
                        if (filter_var($image_name, FILTER_VALIDATE_URL)) {
                            $source_image = file_get_contents($image_name);

                            $path = parse_url($image_name, PHP_URL_PATH);
                            $new_name = time() . '_' . basename($path);
                            $dest_img = public_path() . '/uploads/documents/' . $new_name;
                            file_put_contents($dest_img, $source_image);
                            $expense_array['document'] = $new_name;
                        } else {
                            $expense_array['document'] = $image_name;
                        }
                    } else {
                        $expense_array['document'] = '';
                    }

                }

                $expense_array['status'] = 'final';
                $expense_array['payment_status'] = 'due';
                $expense_array['type'] = 'expense';

                $transaction = Transaction::create($expense_array);

                $paid_amount = trim($value[11]);

                if (!empty($paid_amount)) {
                    $paid_amount = $this->transactionUtil->num_uf($paid_amount);
                } else {
                    $is_valid = false;
                    $error_msg = "Amount not found in row no. $row_no";
                    break;
                }

                $paid_on = trim($value[12]);

                //check if date is correct
                if (!empty($paid_on)) {
                    try {
                        \Carbon::parse($paid_on);
                    } catch (\Exception $e) {
                        throw new \Exception(__('lang_v1.invalid_date_format_at', ['row' => $row_no]));
                    }
                }

                if (!empty($paid_on)) {
                    $paid_on = $paid_on;
                } else {
                    $paid_on= \Carbon::now()->toDateTimeString();
                }

                $payment_method = trim($value[13]);
                if (!empty($payment_method)) {

                    $payment_types = $this->transactionUtil->payment_types(null, false, $business_id);
                    if (!in_array($payment_method, $payment_types)) {
                        $is_valid = false;
                        $error_msg = "This Payment Method not exit in row no. $row_no";
                        break;
                    }
                    $payment_method = array_search($payment_method, $payment_types);
                } else {
                    $is_valid = false;
                    $error_msg = "Payment Method not found in row no. $row_no";
                    break;
                }

                $account_number = trim($value[14]);
                $account_id = null;
                if (!empty($account_number)) {

                    $account = Account::where('account_number', $account_number)->where('business_id', $business_id)->first();
                    if (!empty($account)) {
                        $account_id = $account->id;
                    } else {
                        $is_valid = false;
                        $error_msg = "Invalid Account Number id in row no. $row_no";
                        break;
                    }
                }
                $t_no = 0;
                for ($i = 1; $i < 8; $i++) {
                    if ($payment_method == 'custom_pay_'.$i) {
                        $t_no = $i;
                        break;
                    }
                }

                $payment[] = [
                    'amount' => $paid_amount,
                    'paid_on' => $paid_on,
                    'method' => $payment_method,
                    'account_id' => $account_id,
                    'note' =>  trim($value[15]),
                    "transaction_no_{$t_no}" => null
                ];
                $this->transactionUtil->createOrUpdatePaymentLines($transaction, $payment, null, null, false);
                $this->transactionUtil->updatePaymentStatus($transaction->id, $transaction->final_total);
            }

            if (!$is_valid) {
                throw new \Exception($error_msg);
            }

        }

        DB::commit();

        $output = ['success' => 1,
            'msg' => __('product.file_imported_successfully'),
        ];

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = ['success' => 0,
                'msg' => $e->getMessage(),
            ];

            return redirect('import-expense')->with('notification', $output);
        }

        return redirect('import-expense')->with('status', $output);

    }

    public function exportTEJ(Request $request)
    {
        $ids = $request->input('ids', []);

        // Get expenses with related data
        $expenses = Transaction::whereIn('id', $ids)
            ->with(['contact', 'tax', 'business', 'location'])
            ->where('type', 'expense')
            ->get();

        if ($expenses->isEmpty()) {
            return response()->json(['error' => 'No expenses found'], 404);
        }

        // Get business information for declarant (the company making the declaration)
        $business = $expenses->first()->business;

        // Get month and year from the first expense
        $firstExpense = $expenses->first();
        $transactionDate = \Carbon\Carbon::parse($firstExpense->transaction_date);

        // Extract business matricule fiscal for declarant (from business)
        $declarantMatriculeFiscal = $business->tax_number_1 ?? '';

        // Code acte (0 for initial declaration)
        $codeActe = '1';

        // Group expenses by beneficiary (contact)
        $groupedByContact = $expenses->groupBy('contact_id');

        // Create XML
        $xml = new \DOMDocument('1.0', 'UTF-8');
        $xml->formatOutput = true;
        $xml->standalone = true;

        // Root element
        $root = $xml->createElement('DeclarationsRS');
        $root->setAttribute('VersionSchema', '1.0');
        $xml->appendChild($root);

        // Declarant section
        $declarant = $xml->createElement('Declarant');
        $root->appendChild($declarant);

        $typeIdentifiant = $xml->createElement('TypeIdentifiant', '1'); // 1 for Matricule Fiscal
        $declarant->appendChild($typeIdentifiant);

        // Declarant is the business (the company making the declaration)
        $identifiant = $xml->createElement('Identifiant', $declarantMatriculeFiscal);
        $declarant->appendChild($identifiant);

        $categorieContribuable = $xml->createElement('CategorieContribuable', 'PM'); // PM for Personne Morale
        $declarant->appendChild($categorieContribuable);

        // Reference Declaration
        $referenceDeclaration = $xml->createElement('ReferenceDeclaration');
        $root->appendChild($referenceDeclaration);

        $acteDepot = $xml->createElement('ActeDepot', $codeActe); // 0 for initial declaration
        $referenceDeclaration->appendChild($acteDepot);

        $anneeDepot = $xml->createElement('AnneeDepot', $transactionDate->format('Y'));
        $referenceDeclaration->appendChild($anneeDepot);

        $moisDepot = $xml->createElement('MoisDepot', $transactionDate->format('m'));
        $referenceDeclaration->appendChild($moisDepot);

        // Ajouter Certificats
        $ajouterCertificats = $xml->createElement('AjouterCertificats');
        $root->appendChild($ajouterCertificats);

        // Process each beneficiary
        foreach ($groupedByContact as $contactId => $contactExpenses) {
            $contact = $contactExpenses->first()->contact;

            if (!$contact) {
                continue; // Skip if no contact
            }

            // Create certificate for this beneficiary
            $certificat = $xml->createElement('Certificat');
            $ajouterCertificats->appendChild($certificat);

            // Beneficiaire section
            $beneficiaire = $xml->createElement('Beneficiaire');
            $certificat->appendChild($beneficiaire);

            // IdTaxpayer
            $idTaxpayer = $xml->createElement('IdTaxpayer');
            $beneficiaire->appendChild($idTaxpayer);

            $matriculeFiscal = $xml->createElement('MatriculeFiscal');
            $idTaxpayer->appendChild($matriculeFiscal);

            $typeIdBenef = $xml->createElement('TypeIdentifiant', '1');
            $matriculeFiscal->appendChild($typeIdBenef);

            // Beneficiary is the contact (supplier/beneficiary receiving payment)
            $identifiantBenef = $xml->createElement('Identifiant', $contact->tax_number ?? '');
            $matriculeFiscal->appendChild($identifiantBenef);

            // Determine if contact is PM or PP based on type
            $categorieBenef = $contact->contact_type === 'individual' ? 'PP' : 'PM';
            $categorieContribuableBenef = $xml->createElement('CategorieContribuable', $categorieBenef);
            $matriculeFiscal->appendChild($categorieContribuableBenef);

            // Resident (1 for resident, 0 for non-resident)
            $resident = $xml->createElement('Resident', '1');
            $beneficiaire->appendChild($resident);

            // Name
            $nomBenef = $xml->createElement('NometprenonOuRaisonsociale');
            $nomBenef->appendChild($xml->createTextNode($contact->name ?? ''));
            $beneficiaire->appendChild($nomBenef);

            // Address
            $adresseBenef = $xml->createElement('Adresse');
            $adresseBenef->appendChild($xml->createTextNode($this->formatAddress($contact)));
            $beneficiaire->appendChild($adresseBenef);

            // Contact Info
            $infosContact = $xml->createElement('InfosContact');
            $beneficiaire->appendChild($infosContact);

            $email = $xml->createElement('AdresseMail', $contact->email ?? '');
            $infosContact->appendChild($email);

            $tel = $xml->createElement('NumTel', $contact->mobile ?? '');
            $infosContact->appendChild($tel);

            // Date Payment (use the last payment date or transaction date)
            $lastExpense = $contactExpenses->sortByDesc('transaction_date')->first();
            $datePayement = $xml->createElement('DatePayement',
                \Carbon\Carbon::parse($lastExpense->transaction_date)->format('d/m/Y')
            );
            $certificat->appendChild($datePayement);

            // Reference certificate
            $refCertif = $xml->createElement('Ref_certif_chez_declarant', $lastExpense->ref_no ?? $lastExpense->invoice_no ?? '');
            $certificat->appendChild($refCertif);

            // Liste Operations
            $listeOperations = $xml->createElement('ListeOperations');
            $certificat->appendChild($listeOperations);

            // Totals for this certificate
            $totalHT = 0;
            $totalTVA = 0;
            $totalTTC = 0;
            $totalRS = 0;
            $totalNetServi = 0;

            // Process each expense for this contact
            foreach ($contactExpenses as $expense) {
                if (!$expense->code_rs) {
                    continue; // Skip if no RS code
                }

                $operation = $xml->createElement('Operation');
                $operation->setAttribute('IdTypeOperation', $expense->code_rs);
                $listeOperations->appendChild($operation);

                // Get RS rate from code_rs mapping
                $rsRate = $this->getRSRate($expense->code_rs);

                // Calculate amounts in millimes (1 TND = 1000 millimes)
                $montantTTC = intval(($expense->final_total/(1-($rsRate / 100)))* 1000);
                $tauxTVA = $expense->tax ? floatval($expense->tax->amount) : 0;

                // Calculate HT (before tax)
                $montantHT =intval( $montantTTC / (1 + ($tauxTVA / 100)));

                $montantTVA = $montantTTC - $montantHT;

                // Calculate RS amount
                $montantRS =intval( $montantTTC  * ($rsRate / 100));

                // Net amount served
                $montantNetServi = intval($expense->final_total* 1000);

                // Add to totals
                $totalHT += $montantHT;
                $totalTVA += $montantTVA;
                $totalTTC += $montantTTC;
                $totalRS += $montantRS;
                $totalNetServi += $montantNetServi;

                // Build operation XML
                $anneeFacturation = $xml->createElement('AnneeFacturation',
                    \Carbon\Carbon::parse($expense->transaction_date)->format('Y')
                );
                $operation->appendChild($anneeFacturation);

                $cnpc = $xml->createElement('CNPC', '0');
                $operation->appendChild($cnpc);

                $pCharge = $xml->createElement('P_Charge', '0');
                $operation->appendChild($pCharge);

                $montantHTElem = $xml->createElement('MontantHT', $montantHT);
                $operation->appendChild($montantHTElem);

                $tauxRSElem = $xml->createElement('TauxRS', number_format($rsRate, 2, '.', ''));
                $operation->appendChild($tauxRSElem);

                $tauxTVAElem = $xml->createElement('TauxTVA', number_format($tauxTVA, 2, '.', ''));
                $operation->appendChild($tauxTVAElem);

                $montantTVAElem = $xml->createElement('MontantTVA', $montantTVA);
                $operation->appendChild($montantTVAElem);

                $montantTTCElem = $xml->createElement('MontantTTC', $montantTTC);
                $operation->appendChild($montantTTCElem);

                $montantRSElem = $xml->createElement('MontantRS', $montantRS);
                $operation->appendChild($montantRSElem);

                $montantNetServiElem = $xml->createElement('MontantNetServi', $montantNetServi);
                $operation->appendChild($montantNetServiElem);
            }

            // Total Payement section
            $totalPayement = $xml->createElement('TotalPayement');
            $certificat->appendChild($totalPayement);

            $totalMontantHT = $xml->createElement('TotalMontantHT', $totalHT);
            $totalPayement->appendChild($totalMontantHT);

            $totalMontantTVA = $xml->createElement('TotalMontantTVA', $totalTVA);
            $totalPayement->appendChild($totalMontantTVA);

            $totalMontantTTC = $xml->createElement('TotalMontantTTC', $totalTTC);
            $totalPayement->appendChild($totalMontantTTC);

            $totalMontantRS = $xml->createElement('TotalMontantRS', $totalRS);
            $totalPayement->appendChild($totalMontantRS);

            $totalMontantNetServi = $xml->createElement('TotalMontantNetServi', $totalNetServi);
            $totalPayement->appendChild($totalMontantNetServi);
        }

        // Generate filename according to TEJ format
        // [MATRICULEFISCAL]-[EXERCICE]-[MOIS]-[CODE_ACTE].xml
        $exercice = $transactionDate->format('Y');  // 4 digits year
        $mois = $transactionDate->format('m');      // 2 digits month (01-12)

        // Remove any spaces or special characters from matricule fiscal
        $cleanMatricule = str_replace([' ', '/', '\\'], '', $declarantMatriculeFiscal);

        $filename = sprintf(
            '%s-%s-%s-%s.xml',
            $cleanMatricule,
            $exercice,
            $mois,
            $codeActe
        );

        // Example: 1234056A-2026-01-0.xml

        // Return XML as download
        return response($xml->saveXML(), 200)
            ->header('Content-Type', 'application/xml')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    /**
     * Format contact address
     */
    private function formatAddress($contact)
    {
        $addressParts = array_filter([
            $contact->address_line_1,
            $contact->address_line_2,
            $contact->city,
            $contact->state,
            $contact->zip_code
        ]);

        return implode(', ', $addressParts);
    }

    /**
     * Get RS rate from code_rs
     */
    private function getRSRate($codeRS)
    {
        $rsRates = [
            // Capital Income
            'RS3_000001' => 20,

            // Board Compensation
            'RS8_000001' => 20,

            // Asset Transfers
            'RS6_000001' => 2.5,
            'RS6_000002' => 2.5,

            // Dividends
            'RS5_000001' => 10,

            // Rentals
            'RS1_000001' => 5,
            'RS1_000002' => 10,

            // Acquisitions
            'RS7_000001' => 1.5,
            'RS7_000002' => 1,
            'RS7_000003' => 0.5,
            'RS7_000004' => 1.5,
            'RS7_000005' => 1,

            // Professional Services
            'RS2_000001' => 10,
            'RS2_000002' => 3,
            'RS2_000003' => 3,
            'RS2_000004' => 5,

            // Gambling
            'RS11_000001' => 25,
        ];

        return $rsRates[$codeRS] ?? 0;
    }
}
