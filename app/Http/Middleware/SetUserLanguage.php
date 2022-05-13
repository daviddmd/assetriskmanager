<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SetUserLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has("set_language")) {
            $language = $request->input("set_language");
            if (Auth::user()) {
                $user = Auth::user();
                if ($user->language != $language) {
                    $user->language = $language;
                    $user->save();
                }
            }
            App::setLocale($language);
        }
        return $next($request);
    }
}
