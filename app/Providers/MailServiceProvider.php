<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PhpMailerService;

class MailServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        /**
         * Bind the class directly (best practice).
         * This allows constructor injection:
         *   public function __construct(private PhpMailerService $mailer) {}
         */
        $this->app->singleton(PhpMailerService::class, function () {
            return new PhpMailerService();
        });

        /**
         * Optional: also bind a short alias for manual resolving:
         *   app('phpmailer')
         */
        $this->app->alias(PhpMailerService::class, 'phpmailer');

        /**
         * IMPORTANT:
         * Do NOT bind 'mailer' here — Laravel uses that internally.
         * Binding 'mailer' can break framework mail features and some packages.
         */
    }

    public function boot(): void
    {
        //
    }
}
