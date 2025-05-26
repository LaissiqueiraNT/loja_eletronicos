<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Request_item extends Model
{
    protected $table = 'request_items';
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

    public function product()
    {
        return $this->hasMany(Product::class);
    }
        public function sale()
    {
        return $this->hasMany(Sale::class);
    }
}
