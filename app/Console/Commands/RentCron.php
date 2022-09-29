<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\RenewRent;
use App\Mail\AdminRenewRent;

class RentCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rent:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check when the rent is due and reset.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $rent_dates = User::where('role_id', 3)->select('id', 'name','email','rent_due', 'paid')->get();

        foreach($rent_dates as $date)
        {
            if(Carbon::now()->lte($date->rent_due)){
                $new = User::findOrFail($date->id)->update([
                    'paid' => 0
                ]);

                Mail::to($date->email)->send(new RenewRent($date));
                Mail::to(config('mail.from.address'))->send(new AdminRenewRent($date));
            }
        }
    }
}
