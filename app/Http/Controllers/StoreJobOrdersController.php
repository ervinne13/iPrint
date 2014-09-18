<?php

namespace App\Http\Controllers;

use App\Models\JobOrder;
use App\Models\Store;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\Datatables\Facades\Datatables;

class StoreJobOrdersController extends Controller {

    protected $statusList = [
        "Open",
        "Awaiting Confirmation",
        "Out of Stock",
        "Rejected",
        "Pending",
        "Ongoing",
        "Ready for Pickup",
        "Cancelled",
        "Fullfilled"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id) {

        $data['store']         = Store::find($id);
        $data['dataFetchType'] = 'fetchAll';

        return view('pages.store-job-orders.index', $data);
    }

    public function datatable($storeId, $active = false) {

        $query = JobOrder::StoreDatatable($storeId);

        if ($active) {
            $query = $query->AwaitingStoreAction();
        }

        return Datatables::of($query)->make(true);
    }

    public function salesSummaryReport($storeId) {

        return [
            "currentMonthSales" => number_format(JobOrder::CurrentMonthSales($storeId), 2, '.', ','),
            "currentYearSales"  => number_format(JobOrder::CurrentYearSales($storeId), 2, '.', ','),
            "pastMonthSales"    => number_format(JobOrder::PastMonthSales($storeId), 2, '.', ','),
            "monthlySales"      => JobOrder::SalesSummaryReport($storeId)
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $storeId
     * @return Response
     */
    public function show($storeId, $jobOrderId) {
        
    }

    public function userOrders($storeId, $userId) {

        return JobOrder::Store($storeId)
                        ->requestedBy($userId)
                        ->unfulfilled()
                        ->with('productJunctions')
                        ->get();
    }

    public function activeOrders($id) {
        $data['store']         = Store::find($id);
        $data['dataFetchType'] = 'activeOnly';

        return view('pages.store-job-orders.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $storeId
     * @return Response
     */
    public function edit($storeId, $jobOrderId) {

        $data["store"]      = Store::find($storeId);
        $data["jobOrder"]   = JobOrder::find($jobOrderId);
        $data["statusList"] = $this->statusList;

        return view('pages.store-job-orders.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $storeId
     * @return Response
     */
    public function update(Request $request, $storeId, $jobOrderId) {

        //  only status and remarks are updatable
        $jobOrder = JobOrder::find($jobOrderId);

        if (!$jobOrder) {
            return response("Job order {$jobOrderId} not found", 404);
        }

        try {
            $jobOrder->status  = $request->status;
            $jobOrder->remarks = $request->remarks;

            $jobOrder->estimated_time_of_completion = $request->estimated_time_of_completion;

            $jobOrder->save();

            return $jobOrder;
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
