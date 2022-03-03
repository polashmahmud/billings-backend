<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($search != '') {
            $customers = Customer::where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->paginate(3);
        } else {
            $customers = Customer::paginate(3);
        }

        return response()->json($customers);
    }


    public function store(StoreCustomerRequest $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        $customer->address = $request->address;
        $customer->save();

        return response()->json([
            'message' => 'Customer created successfully',
            'customer' => $customer
        ], 201);
    }

    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->only(['name', 'address']));

        return response()->json([
            'message' => 'Customer updated successfully',
            'customer' => $customer
        ], 200);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json([
            'message' => 'Customer deleted successfully',
            'customer' => $customer
        ], 200);
    }

}
