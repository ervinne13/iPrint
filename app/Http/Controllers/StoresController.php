<?php

namespace App\Http\Controllers;

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
    public function index() {
        return view('pages.stores.index');
    }

    public function datatable() {
        return Datatables::of(Store::query()->with('owner'))->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

        $data["shop"]        = new Store();
        $data["shop"]->owner = new User();
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
