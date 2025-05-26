<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Request_item;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $guarded = ['id'];

    // public function request()
    // {
    //     return $this->belongsTo(Request_item::class);
    // }
    public function product()
    {
        return $this->belongsToMany(Product::class)
        ->withPivot('quantity', 'unit_price')
        ->withTimestamps();
    }
}
