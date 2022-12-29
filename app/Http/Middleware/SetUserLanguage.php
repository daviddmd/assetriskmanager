<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SetUserLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has("set_language")) {
            $path = $request->path();
            $language = $request->input("set_language");
            if (array_key_exists($language, config("app.locales"))) {
                if (Auth::user()) {
                    $user = Auth::user();
                    if ($user->language != $language) {
                        $user->language = $language;
                        $user->save();
                    }
                }
                Session::put("locale", $language);
                $this->setLanguage();
            }
            return redirect()->to($path);
        }
        $this->setLanguage();
        return $next($request);
    }

    private function setLanguage()
    {
        if (Session::has("locale")) {
            App::setLocale(Session::get("locale"));
        }
    }
}
