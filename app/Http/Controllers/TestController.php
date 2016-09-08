<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\URL;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class TestController extends Controller {

    const PAYPAL_CLIENT_ID = "ASUXks84M_5rHBOYWpocnThOE30e_lqyzs_BJ9bgpUGE932Z3h-_sqM6Cj8HGIlgZK2IPfNE0mVxwD35";
    const PAYPAL_SECRET    = "EFuvcXQbtW_uMtSsMr3kqPjtpMVKaJchzSKtm0r1k79upAloL9N8JS5sRRUpWzkf2ZJf4JmEOzhghzvi";

    public function paypal() {

        $oauthToken = new OAuthTokenCredential(self::PAYPAL_CLIENT_ID, self::PAYPAL_SECRET);
        $paypalCtx  = new ApiContext($oauthToken);

        $product  = "Test Product";
        $price    = 1.00;
        $shipping = 1.00;

        $total = $price + $shipping;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName($product);
        $item->setCurrency('PHP');
        $item->setQuantity(1);
        $item->setPrice($price);

        $itemList = new ItemList();
        $itemList->setItems(array($item));

        $details = new Details();
        $details->setShipping($shipping);
        $details->setSubtotal($price);
        
        $amount = new Amount();
        $amount->setCurrency('PHP');
        $amount->setTotal($total);
        $amount->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setItemList($itemList);
        $transaction->setDescription("Test Payment Only!!");
        $transaction->setInvoiceNumber("SI-100001");

        $baseUrl = URL::to('/');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("{$baseUrl}/test/paypal/payment/success");
        $redirectUrls->setCancelUrl("{$baseUrl}/test/paypal/payment/cancelled");

        $payment = new Payment();
        $payment
                ->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction])
        ;

        try {
            $payment->create($paypalCtx);
            $approvalUrl = $payment->getApprovalLink();

            return $approvalUrl;
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function payment($status) {
        return $status;
    }

}
