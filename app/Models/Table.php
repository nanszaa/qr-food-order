<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'table_number',
        'qr_token',
        'is_active',
    ];

    public function customerSessions()
    {
        return $this->hasMany(
            CustomerSession::class,
            'table_id',
            'id'
        );
    }
}