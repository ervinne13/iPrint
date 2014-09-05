<?php

use App\Models\JobOrder;
use App\Models\JobOrderProduct;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateSampleTransactions extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        try {
            DB::beginTransaction();
            $samples = $this->createSamples($this->registerUser());
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return response($e->getMessage(), 500);
        }
    }

    private function createSamples($sampleUser) {

        $currentDate = new DateTime();

        $template = [
            "store_id"             => 2,
            "requested_by_user_id" => $sampleUser->id,
            "total_item_qty"       => 2
        ];

        $products = Product::where("store_id", 2)->with('productUOM')->get();

        for ($i = 0; $i < 50; $i ++) {
            $testDate = $currentDate->sub(new DateInterval('P' . ($i + 1) . 'D'));

            $jobOrder             = new JobOrder($template);
            $jobOrder->created_at = $testDate;
            $jobOrder->updated_at = $testDate;
            $jobOrder->payment_ref_no = "SP-" . str_pad($i, 5);
            
            $jobOrder->save();

            $result = $this->produceRandomProducts($jobOrder->id, $products);

            $jobOrder->total_item_qty = count($result["products"]);
            $jobOrder->total_cost     = $result["total_cost"];

            $jobOrder->update();
        }
    }

    private function produceRandomProducts($jobOrderId, $products) {

        $result = [
            "total_cost" => 0,
            "products"   => []
        ];

        //  random number of products
        $productCount = rand(1, 2);

        for ($i = 0; $i < $productCount; $i ++) {
            //  random qty
            $qty      = rand(1, 5);
            $subTotal = $qty * $products[$i]->productUOM[0]->price_per_uom;

            $jobOrderProduct                   = new JobOrderProduct();
            $jobOrderProduct->job_order_id     = $jobOrderId;
            $jobOrderProduct->product_id       = $products[$i]->id;
            $jobOrderProduct->product_uom_code = $products[$i]->productUOM[0]->uom_code;
            $jobOrderProduct->qty              = $qty;
            $jobOrderProduct->sub_total        = $subTotal;

            $jobOrderProduct->save();

            $result["total_cost"] += $subTotal;
            array_push($result["products"], $jobOrderProduct);
        }

        return $result;
    }

    private function registerUser() {

        $user = new User();

        $user->role_code = Role::CODE_USER;
        $user->name      = "John Doe (Test User)";
        $user->api_token = str_random(60);
        $user->password  = \Hash::make("password");

        $user->save();

        return $user;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        JobOrder::where("store_id", 2)->where('created_at', '<', '2016-09-01 07:05:03')->delete();
        User::where('email', 'test_buyer@lap.com')->delete();
    }

}
