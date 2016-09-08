<?php

namespace App\Http\Controllers;

use App\Models\SalesInvoice;
use App\Models\SalesInvoiceDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

            DB::commit();

            return $si;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response($e->getMessage(), 400);
        }
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
