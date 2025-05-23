<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request_item extends Model
{
    protected $table = 'requests';
    protected $guarded = ['id'];
    // protected $fillable = [
    //     'product_id',
    //     'quantity',
    //     'total_price',
    //     'request_date',
    //     'customer_name',
    //     'customer_email',
    //     'customer_phone'
    // ];
}
