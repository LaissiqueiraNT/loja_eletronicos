<?php

namespace App\Models;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Model;

class Request_item extends Model
{
    protected $fillable = ['sale_id', 'product_id', 'quantity', 'unit_price'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
