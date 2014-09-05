<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductUOM;
use App\Models\Store;
use App\Models\UOM;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class StoreProductsController extends Controller {

    public function index($storeId, Request $request) {
        $data["store"] = Store::find($storeId);
        if ($request->ajax() || $request->wantsJson()) {
            return Product::
                            where("store_id", $storeId)
                            ->with('store')
                            ->with('productUOM')
                            ->with('productUOM.uom')
                            ->get();
        } else {
            return view('pages.store-products.index', $data);
        }
    }

    public function datatable($storeId) {
        $query = Product::query()->with('store')
                ->where("store_id", $storeId)
        ;
        return Datatables::of($query)->make(true);
    }

    public function create($storeId) {
        $data["store"]        = Store::find($storeId);
        $data["product"]      = new Product();
        $data["availableUOM"] = UOM::all();

        return view('pages.store-products.create', $data);
    }

    public function store($storeId, Request $request) {

        $request_assoc = $request->all();

        try {
            DB::beginTransaction();
            $product           = new Product($request_assoc);
            $product->store_id = $storeId;

            $product->save();
            foreach ($request->product_uom AS $uom) {
                $productUOM = new ProductUOM($uom);
                $product->productUOM()->save($productUOM);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response($e->getMessage(), 500);
        }
        return $product;
    }

    public function edit($storeId, $productId) {

        $data["store"]        = Store::find($storeId);
        $data["product"]      = Product::find($productId);
        $data["availableUOM"] = UOM::all();

        return view('pages.store-products.edit', $data);
    }

    public function update($storeId, $productId, Request $request) {

        $request_assoc = $request->all();

        try {
            DB::beginTransaction();
            $product           = Product::find($productId);
            $product->fill($request_assoc);
            $product->store_id = $storeId;

            $product->update();
            ProductUOM::where('product_id', $productId)->delete();
            foreach ($request->product_uom AS $uom) {
                $productUOM = new ProductUOM($uom);
                $product->productUOM()->save($productUOM);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response($e->getMessage(), 500);
        }
        return $product;
    }

}
