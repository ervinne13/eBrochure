<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model {

    protected $table    = "categories";
    public $timestamps  = false;
    protected $fillable = ["name", "description"];

}
