<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $guarded = ['id'];
    // protected $fillable = [
    //     'product_id',
    //     'quantity',
    //     'total_price',
    //     'sale_date',
    //     'customer_name',
    //     'customer_email',
    //     'customer_phone'
    // ];
}
