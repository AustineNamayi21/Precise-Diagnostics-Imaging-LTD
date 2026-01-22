<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PhpMailerService;

class MailServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('phpmailer', function ($app) {
            return new PhpMailerService();
        });
        
        // Bind PhpMailerService to Laravel's Mail facade
        $this->app->bind('mailer', function ($app) {
            return $app->make(PhpMailerService::class);
        });
    }

    public function boot()
    {
        //
    }
}