<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id'    => 'required',
            'bill_month'     => 'required',
            'bill_year'      => 'required',
            'bill_date'      => 'required|date',
            'bill_amount'    => 'required',
            'bill_paid_date' => 'nullable|date',
            'bill_status'    => 'required, in:paid,unpaid',
        ];
    }
}
