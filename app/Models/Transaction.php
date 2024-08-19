<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\Order;

class Transaction extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
