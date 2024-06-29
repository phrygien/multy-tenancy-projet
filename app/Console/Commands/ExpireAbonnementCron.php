<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Abonnement;
use Carbon\Carbon;
use App\Mail\RenewalReminder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ExpireAbonnementCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();
        $user = Auth::user();
        // Abonnements expirant dans 1 jour
        $expiringSubscriptions = Abonnement::where('fin', $today->addDay())->get();

        foreach ($expiringSubscriptions as $subscription) {
            $user = $subscription->user; // Assuming the `Abonnement` model has a `user` relationship
    
            if ($user && $user->email) {
                Mail::to($user->email)->send(new RenewalReminder($subscription));
            } else {
                Log::error("User or user's email not found for subscription ID: " . $subscription->id);
            }
        }

        // foreach ($expiringSubscriptions as $subscription) {
        //     // Envoyer un rappel de renouvellement
        //     $user->notify(new RenewalReminder($subscription));
        // }

        info('Renewal reminders sent successfully!'. $expiringSubscriptions);
    }
}
