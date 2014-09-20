<?php

namespace App\Http\Controllers;

use App\Models\JobOrder;
use App\Models\Role;
use App\Models\Store;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class StoresController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            return Store::with('owner')->get();
        } else {
            return view('pages.stores.index');
        }
    }

    public function active() {
        return Store::Active()->with('owner')->get();
    }

    public function datatable() {
        return Datatables::of(Store::query()->active()->with('owner'))->make(true);
    }

    public function usersWithOpenOrders($storeId) {
        $openJobOrders   = JobOrder::Store($storeId)->open()->with('requestedBy')->get();
        $usersWithOrders = [];

        foreach ($openJobOrders AS $jobOrder) {
            array_push($usersWithOrders, [
                "name"         => $jobOrder->requestedBy->name,
                "email"        => $jobOrder->requestedBy->email,
                "order_status" => $jobOrder->status
            ]);
        }

        return $usersWithOrders;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

        $data["shop"]        = new Store();
        $data["shop"]->owner = new User();

        $data["mode"] = "create";

        return view("pages.stores.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {

        $request_assoc = $request->all();

        $shop             = new Store($request_assoc);
        $owner            = new User($request_assoc["owner"]);
        $owner->role_code = Role::CODE_STORE_OWNER;
        $owner->password  = \Hash::make($request_assoc["owner"]["password1"]);

        try {
            DB::beginTransaction();

            $owner->save();
            $owner->ownedShop()->save($shop);

            DB::commit();
            return $shop;
        } catch (Exception $e) {
            DB::rollBack();
            return response($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $data["store"] = Store::find($id);

        $data["jobOrders"] = JobOrder::
                Store($id)
                ->NewestOrders(5)
                ->with(['productJunctions' => function($query) {
                        $query->leftJoin('products', 'product_id', '=', 'id');
                    }])
                ->get();

//        return $data["jobOrders"];
        return view('pages.stores.store', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $data["shop"] = Store::find($id);
        $data["mode"] = "edit";

        return view("pages.stores.edit", $data);
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
            $store = Store::find($id);

            if ($store) {
//                $store->min_order_limit = $request->min_order_limit;
                $store->fill($request->toArray());
                $store->save();
                return $store;
            } else {
                return response("Store not found", 404);
            }
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    public function deactivate($id) {

        try {
            $store = Store::find($id);

            if ($store) {
                $store->is_active = 0;
                $store->save();
                return $store;
            } else {
                return response("Store not found", 404);
            }
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
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
