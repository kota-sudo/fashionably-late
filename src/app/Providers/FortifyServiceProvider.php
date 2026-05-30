<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);

        Fortify::authenticateThrough(function () {
            return array_filter([
                config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
                function (Request $request, $next) {
                    Validator::make($request->all(), [
                        Fortify::username() => ['required', 'email'],
                        'password' => ['required'],
                    ], [
                        'email.required' => 'メールアドレスを入力してください',
                        'email.email' => 'メールアドレスはメール形式で入力してください',
                        'password.required' => 'パスワードを入力してください',
                    ])->validate();

                    return $next($request);
                },
                AttemptToAuthenticate::class,
                PrepareAuthenticatedSession::class,
            ]);
        });

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            return null;
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });
    }
}
