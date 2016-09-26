<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $fillable = [
        "category_id", "model", "stock", "name", "price", "status", "description"
    ];
    
    public function scopeKeyword($query, $keyword) {

        $where = array(strtolower("%{$keyword}%"));

        return $query
                        ->select(array('products.*', 'url AS image_url'))
                        ->leftJoin('categories', 'category_id', '=', 'categories.id')
                        ->leftJoin('product_images', 'product_id', '=', 'products.id')
                        ->whereRaw('LOWER(products.name) like ?', $where)
                        ->orWhereRaw('LOWER(products.description) like ?', $where)
                        ->orWhereRaw('LOWER(categories.name) like ?', $where)
        ;
    }

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
