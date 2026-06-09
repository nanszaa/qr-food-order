<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerSession extends Model
{
    protected $primaryKey = 'customer_session_id';

    protected $fillable = [
        'table_id',
        'session_token',
        'customer_name',
        'status',
        'expired_at',
    ];

    public function table()
    {
        return $this->belongsTo(
            Table::class,
            'table_id',
            'id'
        );
    }

    public function orders()
    {
        return $this->hasMany(
            Order::class,
            'customer_session_id',
            'customer_session_id'
        );
    }
}