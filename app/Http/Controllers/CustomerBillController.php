<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerBillController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $bills = auth()->user()->bills()->get();

        return response()->json([
            'bills' => $bills,
            'customer' => auth()->user(),
        ]);
    }
}
