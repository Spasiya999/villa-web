<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                \App\Models\Setting::loadAll();
                
                $mailHost = \App\Models\Setting::get('mail_host');
                if (!empty($mailHost)) {
                    config([
                        'mail.mailers.smtp.host' => $mailHost,
                        'mail.mailers.smtp.port' => \App\Models\Setting::get('mail_port', 465),
                        'mail.mailers.smtp.encryption' => \App\Models\Setting::get('mail_encryption', 'ssl'),
                        'mail.mailers.smtp.username' => \App\Models\Setting::get('mail_username'),
                        'mail.mailers.smtp.password' => \App\Models\Setting::get('mail_password'),
                        'mail.from.address' => \App\Models\Setting::get('mail_from_address', \App\Models\Setting::get('mail_username')),
                        'mail.from.name' => \App\Models\Setting::get('mail_from_name', \App\Models\Setting::get('site_name', config('app.name'))),
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Ignore during migrations or when database is not ready
        }
    }
}
