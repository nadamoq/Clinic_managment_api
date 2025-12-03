<?php

namespace App\Console\Commands;

use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredPatient extends Command
{
    /**
     * The name and signature of the console command.
     
     * @var string
     */
    protected $signature = 'app:delete-expired-patient';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Expired Patient every 3 months';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $three_months_ago=Carbon::now()->subMonths(3);
        
        Patient::with([
                        'appointment'=>fn($q)=>$q->completed()
                                    ->get()
                    ])
                    ->where('created_at','<=',$three_months_ago)
                    ->delete();
    }
}
