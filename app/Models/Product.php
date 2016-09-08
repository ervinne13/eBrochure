<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $fillable = [
        "category_id", "model", "stock", "name", "price", "status", "description"
    ];

    public function image() {
        //  first image only
        return $this->hasOne(ProductImage::class, 'product_id');
    }

    public function images() {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function category() {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function scopeCategoryId($query, $categoryId) {
        return $query->where('category_id', $categoryId);
    }

}
