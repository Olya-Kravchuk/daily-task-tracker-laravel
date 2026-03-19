<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;

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
        $loginRateLimitResponse = function(Request $request) {
            if ($request->exceptsJson()) {
                return response()->json(
                    [
                        'message' => 'Too many login attempts. Please try agaun later.',
                    ],
                    429
                );
            }
            
            return back()->withErrors(
                ['email' => 'Too many login attempts. Please try agaun later.']
            )->withInput($request->except('password'));
        };
        RateLimiter::for('login', function(Request $request) use ($loginRateLimitResponse) {
        // RateLimiter::for('login', function(Request $request) {
            return [
                Limit::perMinute(100)->by($request->ip())->response($loginRateLimitResponse),
            //     Limit::perMinute(100)
            // ->by($request->ip())
            // ->response(function () {
            //     throw ValidationException::withMessages([
            //         'email' => 'Too many login attempts. Please try again later.'
            //     ]);
            // }),
                Limit::perMinute(5)->by($request->input('email'))->response($loginRateLimitResponse),
            ];
        });

        Password::default(function() {
            if ($this->app->isLocal()) {
                return Password::min(8);
            }

            return Password::min(8)->mixedCase()->uncompromised()->letters()->numbers()->symbols();
        });
    }
}
