<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\CheckMembershipStatus;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log; //meningkatkan perofrma antrian agar cepat;


class CheckMemberships extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'membership:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and deactivate expired memberships';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Bus::batch([
            new CheckMembershipStatus(),
        ])->then(function (Batch $batch) {
            Log::info('All membership status checks completed successfully.');
        })->catch(function (Batch $batch, Throwable $e) {
            Log::error('An error occurred during membership status checks: ' . $e->getMessage());
        })->finally(function (Batch $batch) {
            Log::info('Membership status check batch has finished.');
        })->dispatch();
    }
}
