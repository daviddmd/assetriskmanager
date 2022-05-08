<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Application|Factory|View
     */

    public function __invoke(Request $request)
    {
        return $request->user()->can("viewAny", User::class) ? view("reports.index", ["assets" => Asset::all()]) : abort(403);
    }
}
