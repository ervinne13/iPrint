<?php

namespace App\Events;

use App\Events\Event;
use App\Models\JobOrder;
use Illuminate\Queue\SerializesModels;

class JobOrderReceived extends Event {

    use SerializesModels;

    private $jobOrder;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(JobOrder $jobOrder) {
        $this->jobOrder = $jobOrder;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn() {
        return [];
    }

    /**
     * 
     * @return JobOrder
     */
    public function getJobOrder() {
        return $this->jobOrder;
    }

}
