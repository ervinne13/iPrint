<?php

namespace App\Listeners;

use App\Events\JobOrderReceived;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobOrderReceivedEventListener {

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param  JobOrderReceived  $event
     * @return void
     */
    public function handle(JobOrderReceived $event) {
        //
    }

}
