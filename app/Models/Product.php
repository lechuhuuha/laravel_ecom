<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $with = ['images'];
    protected $fillable = [
        'name', 'description', 'image', 'price', 'type'
    ];
    public function getPriceAttribute($value)
    {
        return "$" . $value;
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }
    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'product_brand', 'product_id', 'brand_id');
    }
    public function images()
    {
        return $this->belongsToMany(Image::class, 'product_image', 'product_id', 'image_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function order_details()
    {
        return $this->hasMany(OrderDetails::class, 'product_id');
    }
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        });
        $query->when($filters['price']   ?? false, function ($query, $price) {
            $query->whereBetween('price', $price);
        });
        // $query->when($filters['category'] ?? false, function ($query, $category) {
        //     $query->whereHas('categories', function ($query, $category) {
        //         $query->where('title', 'like', '%' . $category . '%');
        //     });
        // });
    }
    public function scopeCategory($query, $name)
    {
        return $query->whereHas('categories', fn ($query) => $query->where('name', 'like', '%' . $name . '%'));
    }
    public function scopeBrand($query, $name)
    {
        return $query->whereHas('brands', fn ($query) => $query->where('name', 'like', '%' . $name . '%'));
    }
}
