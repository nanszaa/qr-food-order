<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'customer_session_id',
        'order_code',
        'total_price',
        'order_status',
        'notes',
    ];

    public function payment()
    {
        return $this->hasOne(
            Payment::class,
            'order_id',
            'order_id'
        );
    }

    public function orderItems()
    {
        return $this->hasMany(
            OrderItem::class,
            'order_id',
            'order_id'
        );
    }

    public function customerSession()
    {
        return $this->belongsTo(
            CustomerSession::class,
            'customer_session_id',
            'customer_session_id'
        );
    }
}