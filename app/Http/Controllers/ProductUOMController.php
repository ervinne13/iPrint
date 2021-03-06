<?php

namespace App\Http\Controllers;

use App\Models\ProductUOM;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Facades\Datatables;

class ProductUOMController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
    }

    public function datatable($productId) {
        $query = ProductUOM::query()
                ->where('product_id', $productId)
                ->with('uom');
        return Datatables::of($query)->make(true);
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
    public function store($productId, Request $request) {
        
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Removes the junction bet. product and uom
     *
     * @param  int  $productId
     * @return Response
     */
    public function destroy($productId, $uomCode) {

        try {
            ProductUOM::find($productId, $uomCode)->delete();
            return "OK";
        } catch (Exception $e) {
            Log::error($e);
            return respones($e->getMessage(), 500);
        }
    }

}
