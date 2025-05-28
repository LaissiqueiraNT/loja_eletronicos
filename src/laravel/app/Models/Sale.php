<?php

namespace App\Models;

use App\Models\User;
use App\Models\Client;
use App\Models\Product;
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
        return $this->belongsTo(Product::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
