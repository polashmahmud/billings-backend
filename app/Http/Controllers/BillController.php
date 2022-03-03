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
       $bill = $customer->bills()->create($request->all());

       return response()->json([
           'message' => 'Bill created successfully',
           'bill' => $bill
       ], 201);
    }

    public function show(Customer $customer, Bill $bill)
    {
        return response()->json([
            'bill' => $bill,
            'customer' => $customer,
        ]);
    }

    public function update(UpdateBillRequest $request, Customer $customer, Bill $bill)
    {
        $bill->update($request->all());

        return response()->json([
            'message' => 'Bill updated successfully',
            'bill' => $bill
        ], 200);
    }

    public function destroy(Customer $customer, Bill $bill)
    {
        $bill->delete();

        return response()->json([
            'message' => 'Bill deleted successfully',
        ], 200);
    }
}
