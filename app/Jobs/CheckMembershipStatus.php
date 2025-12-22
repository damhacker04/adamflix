<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Membership;
use App\Events\MembershipHasExpired;
use Illuminate\Bus\Batchable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;



class CheckMembershipStatus implements ShouldQueue
{
     use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $timeout = 120;
    public $tries = 3;
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Membership::where('active', true)
        ->where('end_date', '<', now()->toDateString())
        ->chunk(100, function ($memberships) {
            foreach ($memberships as $membership) {
                $membership->update(['active' => false]);

                event(new MembershipHasExpired($membership));

                
            }
        });
    }
}
