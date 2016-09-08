<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\Datatables\Facades\Datatables;

class CategoriesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        
        if ($request->ajax() || $request->wantsJson()) {
            return ProductCategory::all();
        } else {
            return view('pages.categories.index');
        }
                
    }

    public function datatable() {
        return Datatables::of(ProductCategory::query())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

        $data["category"] = new ProductCategory();

        return view('pages.categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        try {
            $requestAssoc = $request->toArray();
            $category     = new ProductCategory($requestAssoc);
            $category->save();
            return $category;
        } catch (Exception $e) {
            return response($e->getMessage());
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
        $data["category"] = ProductCategory::find($id);
        return view('pages.categories.edit', $data);
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
            $requestAssoc = $request->toArray();
            $category     = ProductCategory::find($id);
            $category->fill($requestAssoc);
            $category->save();
            return $category;
        } catch (Exception $e) {
            return response($e->getMessage());
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
