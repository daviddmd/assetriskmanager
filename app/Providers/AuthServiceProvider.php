<?php

namespace App\Providers;

use App\Models\User;
use Hash;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        if (config("ldap.enabled")) {
            Fortify::authenticateUsing(function ($request) {
                $validated = Auth::validate([
                    'userPrincipalName' => $request->email,
                    'password' => $request->password,
                    // In case LDAP server is down, uses user cached password
                    'fallback' => [
                        'email' => $request->email,
                        'password' => $request->password
                    ],
                ]);
                return $validated ? Auth::getLastAttempted() : null;
            });
        }
        else {
            Fortify::authenticateUsing(function ($request) {
                $user = User::where('email', $request->email)->first();
                $validated = $user && Hash::check($request->password, $user->password);
                return $validated ? $user : null;
            });
        }

    }
}
