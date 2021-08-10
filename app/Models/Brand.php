<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    protected $with = ['products'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_brand', 'brand_id', 'product_id');
    }
}
