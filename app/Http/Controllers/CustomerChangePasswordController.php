<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerChangePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param ChangePasswordRequest $request
     * @param Customer $customer
     * @return JsonResponse
     */
    public function __invoke(ChangePasswordRequest $request, Customer $customer): JsonResponse
    {
        $customer->update(['password' => bcrypt($request->password)]);
        return response()->json(['message' => 'Password updated successfully!']);
    }
}
