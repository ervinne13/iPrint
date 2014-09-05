<?php

namespace App\Http\Controllers;

use App\Models\UOM;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\Datatables\Facades\Datatables;

class UOMController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('pages.uom.index');
    }

    public function datatable() {
        return Datatables::of(UOM::query())->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

        $data["uom"] = new UOM();

        return view('pages.uom.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        $request_assoc = $request->all();
        try {
            $uom = new UOM($request_assoc);
            $uom->save();

            return $uom;
        } catch (Exception $e) {
            return response($e->getMessage(), 400); //  bad request
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

        $data["uom"] = UOM::find($id);
        return view('pages.uom.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {

        $request_assoc = $request->all();

        try {
            $uom = UOM::find($id);

            if ($uom) {
                $uom->fill($request_assoc);
                $uom->save();

                return $uom;
            } else {
                return response("UOM not found", 404);
            }
        } catch (Exception $e) {
            return response($e->getMessage(), 400); //  bad request
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        try {
            $uom = UOM::find($id);

            if ($uom) {
                $uom->delete();

                return "OK";
            } else {
                return response("UOM not found", 404);
            }
        } catch (Exception $e) {
            return response($e->getMessage(), 500); //  internal server error
        }
    }

}
