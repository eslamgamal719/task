<?php

namespace App\Console\Commands;

use \Carbon\Carbon;
use \App\Models\User;
use \App\Mail\AdvertiserMail;
use Illuminate\Console\Command;
use \Illuminate\Support\Facades\Mail;


class NotifyAdvertiser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'advertiser:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify advertisers who have ads the next day';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $advertisers = User::whereHas('ads', function($q) {
            $q->where('start_date', '>', Carbon::now()->subDays(1));
        })->get();

        foreach($advertisers as $advertiser) {
            Mail::to($advertiser)->send(new AdvertiserMail($advertiser));
        }
    }
}
