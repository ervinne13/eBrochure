<?php

namespace App\Http\Controllers;

use App\Models\SalesInvoice;
use App\Models\SalesInvoiceDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use TijsVerkoyen\CssToInlineStyles\Exception;
use Yajra\Datatables\Facades\Datatables;

class SalesInvoicesController extends Controller {

    protected $statusList = [
        "Open",
        "Awaiting Payment",
        "Confirmed Payment",
        "Out of Stock",
        "Rejected",
        "Packaging",
        "For Pickup",
        "Fullfilled",
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('pages.sales-invoices.index');
    }

    public function datatable() {
        return Datatables::of(SalesInvoice::query())->make(true);
    }

    public function pay() {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {

        $requestAssoc = $request->toArray();

        try {

            DB::beginTransaction();

            $si         = new SalesInvoice($requestAssoc);
            $si->status = "Awaiting Payment";
            $si->save();

            $details = array();

            foreach ($requestAssoc["details"] AS $detail) {
                $siDetail                   = new SalesInvoiceDetail($detail);
                $siDetail->sales_invoice_id = $si->id;

                $siDetail->save();
                array_push($details, $siDetail);
            }

            $si->details = $details;

            $payment    = $this->generatePayment($si);
            $paymentUrl = $payment->getApprovalLink();
            $paymentId  = $payment->getId();

            unset($si->details);
            $si->payment_token = $paymentId;
            $si->save();

            DB::commit();

            return [
                "si"         => $si,
                "paymentUrl" => $paymentUrl,
                "paymentId"  => $paymentId,
            ];
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response($e->getMessage(), 400);
        }
    }

    private function getPaypalCtx() {
        $paypalClientID = env('PAYPAL_CLIENT_ID');
        $paypalSecret   = env('PAYPAL_SECRET');

        $oauthToken = new OAuthTokenCredential($paypalClientID, $paypalSecret);
        $paypalCtx  = new ApiContext($oauthToken);
        return $paypalCtx;
    }

    private function generatePayment($si) {
        $paypalCtx = $this->getPaypalCtx();

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $items = [];
        foreach ($si->details AS $detail) {
            $item = new Item();
            $item->setName($detail->product->name);
            $item->setCurrency('PHP');
            $item->setQuantity($detail->qty);
            $item->setPrice($detail->product->price);

            array_push($items, $item);
        }

        $itemList = new ItemList();
        $itemList->setItems($items);

        $details = new Details();
        $details->setShipping(0.00);
        $details->setSubtotal($si->total_amount);

        $amount = new Amount();
        $amount->setCurrency('PHP');
        $amount->setTotal($si->total_amount);
        $amount->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setItemList($itemList);
        $transaction->setDescription("Sales for Forever Jo Trading");
        $transaction->setInvoiceNumber("SI-" . str_pad($si->id, 8, "0", STR_PAD_LEFT));

        $baseUrl = URL::to('/');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("{$baseUrl}/si/payment/success");
        $redirectUrls->setCancelUrl("{$baseUrl}/si/payment/cancelled");

        $payment = new Payment();
        $payment
                ->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction])
        ;

        try {
            $payment->create($paypalCtx);
            return $payment;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function paymentResult($status, Request $request) {

        if ($status == 'success') {
            $paypalCtx = $this->getPaypalCtx();

            $paymentId = $request->paymentId;
            $payerId   = $request->PayerID;

            $payment = Payment::get($paymentId, $paypalCtx);

            $execute = new PaymentExecution();
            $execute->setPayerId($payerId);

            try {

                $result = $payment->execute($execute, $paypalCtx);

                $invoice                = SalesInvoice::PaymentId($paymentId)->first();
                $invoice->status        = "Payment Confirmed";
                $invoice->payment_token = "";
                $invoice->save();
            } catch (\Exception $e) {
                return response($e->getMessage(), 500);
            }
        }

        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {

        $data["si"]         = SalesInvoice::find($id);
        $data["statusList"] = $this->statusList;
        return view('pages.sales-invoices.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {

        try {

            DB::beginTransaction();

            $si           = SalesInvoice::find($id);
            $si->status   = $request->status;
            $si->discount = $request->discount;
            $si->save();

            DB::commit();

            return $si;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response($e->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
