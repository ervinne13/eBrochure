<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;

class UsersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('pages.users.index');
    }

    public function datatable() {
        return Datatables::of(User::NonAdmin())->make(true);
    }

    public function login(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return Auth::user();
        } else {
            return false;
        }
    }

    private function getPaypalCtx() {
        $paypalClientID = env('PAYPAL_CLIENT_ID');
        $paypalSecret   = env('PAYPAL_SECRET');

        $oauthToken = new OAuthTokenCredential($paypalClientID, $paypalSecret);
        $paypalCtx  = new ApiContext($oauthToken);
        return $paypalCtx;
    }

    private function generatePayment(User $user) {

        $membershipFee = 1000;

        $paypalCtx = $this->getPaypalCtx();

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName("Membership Fee");
        $item->setCurrency('PHP');
        $item->setQuantity(1);
        $item->setPrice($membershipFee);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details = new Details();
        $details->setShipping(0.00);
        $details->setSubtotal($membershipFee);

        $amount = new Amount();
        $amount->setCurrency('PHP');
        $amount->setTotal($membershipFee);
        $amount->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setItemList($itemList);
        $transaction->setDescription("Forever Jo Trading Membership");

        $baseUrl = URL::to('/');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("{$baseUrl}/users/payment/success");
        $redirectUrls->setCancelUrl("{$baseUrl}/users/payment/cancelled");

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
            echo $e->getCode(); // Prints the Error Code
            echo $e->getData(); // Prints the detailed error message 
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

                $user            = User::PaymentId($paymentId)->first();
                $user->is_active = 1;
                $user->save();
            } catch (\Exception $e) {
                return response($e->getMessage(), 500);
            }

            return $result;
        } else {
            return "Cancelled";
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {

        try {
            $user            = new User($request->toArray());
            $user->is_active = 0;
            $user->api_token = str_random(60);
            $user->password  = \Hash::make($request->password);
            $user->role_code = "PREMIUM_USER";

            $payment    = $this->generatePayment($si);
            $paymentUrl = $payment->getApprovalLink();
            $paymentId  = $payment->getId();

            $user->payment_token = $paymentId;

            $user->save();

            return [
                "user"       => $user,
                "paymentUrl" => $paymentUrl
            ];
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }

        return $request;
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

}
