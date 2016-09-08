<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesInvoiceDetail extends Model {

    protected $fillable = [
        "sales_invoice_id", "product_id", "qty", "sub_total"
    ];

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

}
