<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeleteExpiredBanners extends Command
{
    protected $signature = 'banners:delete-expired';
    protected $description = 'Delete expired banners';

    public function handle()
    {
        try {
            // Get the current datetime
            $now = Carbon::now();

            // Delete expired banners directly from the database
            DB::table('banners')->where('end_time', '<', $now)->delete();

            // Output a message indicating success
            $this->info('Expired banners deleted successfully.');
        } catch (\Exception $e) {
            // Log and display any errors
            $this->error("Error deleting expired banners: {$e->getMessage()}");
        }
    }
}
