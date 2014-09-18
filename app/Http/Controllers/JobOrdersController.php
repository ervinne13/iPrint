<?php

namespace App\Http\Controllers;

use App\Models\JobOrder;
use App\Models\JobOrderProduct;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class JobOrdersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    public function ofUser($userId) {
        return JobOrder::Unfulfilled()
                        ->requestedBy($userId)
                        ->with('job_order_products')
                        ->get();
    }

    public function cancel($jobOrderId) {

        $jo = JobOrder::find($jobOrderId);
        if ($jo) {
            try {
                $jo->status = "Cancelled";
                $jo->save();
                return $jo;
            } catch (\Exception $e) {
                return response($e->getMessage(), 500);
            }
        } else {
            return response("Job order not found", 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {

        $request_assoc = $request->toArray();

        $jobOrderProducts = [];
        $jobOrder         = new JobOrder($request_assoc);

        if ($this->startsWith($jobOrder->attachment_url, "//")) {
            $jobOrder->attachment_url = substr($jobOrder->attachment_url, 1);
        }

        if ($this->startsWith($jobOrder->payment_supporting_attachment_url, "//")) {
            $jobOrder->payment_supporting_attachment_url = substr($jobOrder->payment_supporting_attachment_url, 1);
        }

        try {
            DB::beginTransaction();

            //  save to generate ID
            $jobOrder->save();

            $totalCost      = 0;
            $totalQty       = 0;
            $products_assoc = $request_assoc["job_order_products"];
            foreach ($products_assoc AS $product_assoc) {
                $product = new JobOrderProduct($product_assoc);

                $product->job_order_id = $jobOrder->id;
                $product->save();

                $totalQty += $product->qty;
                $totalCost += $product->qty * $product->sub_total;

                array_push($jobOrderProducts, $product);
            }

            //  save to update item qty and cost
            $jobOrder->total_item_qty = $totalQty;
            $jobOrder->total_cost     = $totalCost;

            $jobOrder->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response($e->getMessage(), 500);
        }

        $response                       = $jobOrder->toArray();
        $response["created_at"]         = (new DateTime($response["created_at"]))->format("m/d/Y G:i A");
        $response["job_order_products"] = $jobOrderProducts;
        return $response;
    }

    private function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
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
