<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use App\Models\UOM;
use Yajra\Datatables\Facades\Datatables;

class StoreProductsController extends Controller {

    public function index($storeId) {
        $data["store"] = Store::find($storeId);
        return view('pages.store-products.index', $data);
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

}
