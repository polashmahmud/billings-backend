<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_no', 'bill_month', 'bill_year', 'bill_date', 'bill_amount', 'bill_paid_date',
        'bill_status', 'customer_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
