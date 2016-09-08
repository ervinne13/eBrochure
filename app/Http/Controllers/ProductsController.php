<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Facades\Datatables;

class ProductsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        return view('pages.products.index');
    }

    public function byCategory($categoryId) {
        if ($categoryId) {
            return Product::with('image')->categoryId($categoryId)->get();
        } else {
            return Product::with('image')->get();
        }
    }

    public function datatable() {
        return Datatables::of(Product::with('category'))->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $data['product']        = new Product();
        $data['product']->image = new ProductImage();
        $data['categories']     = ProductCategory::all();

        return view('pages.products.create', $data);
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

            $product = new Product($requestAssoc);
            $product->save();

            $productImage             = new ProductImage();
            $productImage->product_id = $product->id;
            $productImage->sort_order = 1;
            $productImage->url        = $requestAssoc["url"];

            $product->image()->save($productImage);

            DB::commit();

            return $product;
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $data['product']    = Product::with('image')->find($id);
        $data['categories'] = ProductCategory::all();

        return view('pages.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $requestAssoc = $request->toArray();
        try {

            DB::beginTransaction();

            $product = Product::find($id);
            $product->fill($requestAssoc);
            $product->save();

            $productImage             = $product->image;
            $productImage->sort_order = 1;
            $productImage->url        = $requestAssoc["url"];

            $product->image()->save($productImage);

            DB::commit();

            return $product;
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
