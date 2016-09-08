<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model {

    public $timestamps  = false;
    protected $fillable = [
        "product_id", "url", "sort_order"
    ];

    public function product() {
        return $this->belongsTo(Product::class, "product_id");
    }

}
