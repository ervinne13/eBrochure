<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model {

    protected $fillable = [
        "document_number", "customer_id", "customer_name", "customer_email", "customer_contact", "customer_address",
        "total_item_qty", "total_amount", "discount", "status"
    ];

    public function getActualDiscount() {
        return ($this->total_amount * $this->discount / 100);
    }

    public function applyDiscount() {
        $this->total_amount = $this->total_amount - $this->getActualDiscount();
    }

    public function revertDiscount() {
        $details            = $this->details;
        $this->total_amount = 0;
        foreach ($details AS $detail) {
            $this->total_amount += $detail->sub_total;
        }
    }

    public function details() {
        return $this->hasMany(SalesInvoiceDetail::class, 'sales_invoice_id');
    }

    public function scopePaymentId($query, $paymentId) {
        return $query->where('payment_token', $paymentId);
    }

}
