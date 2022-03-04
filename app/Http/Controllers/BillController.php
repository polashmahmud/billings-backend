<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\Bill;
use App\Models\Customer;
use Illuminate\Http\Request;

class BillController extends Controller
{

    public function index(Customer $customer)
    {
        $bills = $customer->bills()->paginate(9);

        return response()->json([
            'bills' => $bills,
            'customer' => $customer,
        ]);
    }

    public function store(StoreBillRequest $request, Customer $customer)
    {
        $bill = new Bill();
        $bill->customer_id = $customer->id;
        $bill->bill_no = $request->bill_no;
        $bill->bill_month = $request->bill_month;
        $bill->bill_year = $request->bill_year;
        $bill->bill_date = "{$request->bill_year}-{$request->bill_month}-01";
        $bill->bill_amount = $request->bill_amount;
        $bill->bill_status = 'unpaid';
        $bill->save();

       return response()->json([
           'message' => 'Bill created successfully',
           'bill' => $bill
       ], 201);
    }

    public function destroy(Customer $customer, Bill $bill)
    {
        $bill->delete();

        return response()->json([
            'message' => 'Bill deleted successfully',
        ], 200);
    }

    public function pay(Customer $customer, Bill $bill)
    {
        $bill->bill_status = 'paid';
        $bill->save();

        return response()->json([
            'message' => 'Bill paid successfully',
            'bill' => $bill
        ], 200);
    }

}
