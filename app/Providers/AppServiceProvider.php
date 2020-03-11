<?php

namespace App\Providers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::version(function () {
            return md5_file(public_path('mix-manifest.json'));
        });

        Inertia::share([
            'errors' => function () {
                return Session::get('errors')
                    ? Session::get('errors')->getBag('default')->getMessages()
                    : (object) [];
            },
            'user' => function () {
                return auth()->user() ? [
                    'person' => auth()->user()->only(['email', 'first_name', 'last_name', 'permissions']),
                    'initials' => auth()->user()->first_name[0] . auth()->user()->last_name[0]
                ]
                    : null;
            }
        ]);
    }
}
