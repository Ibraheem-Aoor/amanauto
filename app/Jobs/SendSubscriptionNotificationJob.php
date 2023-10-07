<?php

namespace App\Jobs;

use App\Notifications\User\SubscriptionNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSubscriptionNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $subscription , $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($subscription , $user)
    {
        $this->subscription = $subscription;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->notify(new SubscriptionNotification($this->subscription));
    }
}
