<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'First_Name',
        'Last_Name',
        'Email',
        'Phone',
        'Address',
        'City',
        'State',
        'Zip_Code',
        'Delivery_Instructions',
        'order_id',
        'status',
        'payment_id',
        'paid_amount',
        'amount',
        'currency',

        // new fields
        'items',
        'progress_status',
        'progress_timeline',
    ];

    protected $casts = [
        'items' => 'array',               // JSON array of item objects
        'progress_timeline' => 'array',
    ];

    public $timestamps = true;
}
