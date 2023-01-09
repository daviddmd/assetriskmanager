<?php

namespace App\Http\Middleware;

use App\Models\User;
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
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /* @var $user User */
        $user = Auth::user();
        if ($request->has("set_language")) {
            $path = $request->path();
            $language = $request->input("set_language");
            if (array_key_exists($language, config("app.locales"))) {
                if ($user) {
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
