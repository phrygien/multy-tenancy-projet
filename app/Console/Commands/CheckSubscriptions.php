<?php

namespace App\Console\Commands;

use App\Models\Abonnement;
use App\Notifications\RenewalReminder;
use Illuminate\Console\Command;

class CheckSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for subscriptions that are about to expire and send renewal reminders';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {        // Date actuelle
        $today = Carbon::today();

        // Abonnements expirant dans 1 jour
        $expiringSubscriptions = Abonnement::where('fin', $today->addDay())->get();

        foreach ($expiringSubscriptions as $subscription) {
            // Envoyer un rappel de renouvellement
            $subscription->user->notify(new RenewalReminder($subscription));
        }

        $this->info('Renewal reminders sent successfully!');
    }
}
