<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $primaryKey = 'menu_id';

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',
        'stock',
        'is_available',
        'is_best_seller',
    ];

    public function category()
    {
        return $this->belongsTo(
            Category::class,
            'category_id',
            'category_id'
        );
    }

    public function orderItems()
    {
        return $this->hasMany(
            OrderItem::class,
            'menu_id',
            'menu_id'
        );
    }
}
