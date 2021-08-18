<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $with = ['order_details'];
    protected $guarded = ['date','del_date','created_at'];
    public function order_details()
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }
    public static function boot()
    {
        parent::boot();
        static::deleting(function ($order) {
            $order->order_details()->delete();
        });
    }
}
