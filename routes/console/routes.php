<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

//$schedule->command('subscriptions:check')->daily();
//Schedule::command('subscriptions:check')->everyMinute();
Schedule::command('demo:cron')->everyMinute();
Schedule::command('expire:cron')->everyMinute();