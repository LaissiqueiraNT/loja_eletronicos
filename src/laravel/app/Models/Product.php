<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\Supplier;
use App\Models\Request_item;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = ['id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function sale()
    {
        return $this->belongsToMany(Sale::class)
            ->withPivot('quantity', 'total_price')
            ->withTimestamps();
    }
}
