<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model {

    protected $fillable = [
        "document_number", "customer_id", "customer_name", "customer_email", "customer_contact", "customer_address",
        "total_item_qty", "total_amount", "discount", "status"
    ];

    public function details() {
        return $this->hasMany(SalesInvoiceDetail::class, 'sales_invoice_id');
    }

}
