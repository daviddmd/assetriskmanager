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
    //FIXME verificar se as tabelas estão no formato certo
    //TODO exportar tabelas para CSV
    //TODO risk map: adicionar coluna probabilidade, substituir coluna risco absoluto por risco total, substituir risco residual por escala 0-125
    //TODO asset list: substituir risk after controls por escala 0-125
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
