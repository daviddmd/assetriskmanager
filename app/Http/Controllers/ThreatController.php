<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreThreatRequest;
use App\Http\Requests\UpdateThreatRequest;
use App\Models\Threat;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ThreatController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Threat::class, 'threat');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $filter = $request->input("filter", "");
        if (!empty($filter)) {
            $threats = Threat::whereRaw(lowerLike("name"), [caseInsensitiveMatch($filter)])->
            orWhereRaw(lowerLike("description"), [caseInsensitiveMatch($filter)])->
            paginate(5)->withQueryString();
        }
        else {
            $threats = Threat::paginate(5)->withQueryString();
        }
        return view("threats.index", ["threats" => $threats, "filter" => $filter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view("threats.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreThreatRequest $request
     * @return RedirectResponse
     */
    public function store(StoreThreatRequest $request)
    {
        $name = $request->input("name");
        $description = $request->input("description");
        $threat = new Threat;
        $threat->fill(["name" => $name, "description" => $description]);
        $threat->save();
        Log::channel("application")->info(sprintf("Create Threat %d (Name: %s, Description: %s)",
            $threat->id, $threat->name, $threat->description));
        return redirect()->route("threats.index")->with("status", __("Threat Created"));
    }

    /**
     * Display the specified resource.
     *
     * @param Threat $threat
     * @return Application|Factory|View
     */
    public function show(Threat $threat)
    {
        return view("threats.show", ["threat" => $threat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Threat $threat
     * @return Application|Factory|View
     */
    public function edit(Threat $threat)
    {
        return view("threats.edit", ["threat" => $threat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateThreatRequest $request
     * @param Threat $threat
     * @return RedirectResponse
     */
    public function update(UpdateThreatRequest $request, Threat $threat)
    {
        $threat->update(
            [
                "name" => $request->input("name"),
                "description" => $request->input("description")
            ]
        );
        Log::channel("application")->info(sprintf("Update Threat %d (Name: %s, Description: %s)",
            $threat->id, $threat->name, $threat->description));
        return redirect()->route("threats.index")->with("status", __("Threat Updated"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Threat $threat
     * @return RedirectResponse
     */
    public function destroy(Threat $threat)
    {
        Log::channel("application")->info(sprintf("Delete Threat %d (Name: %s, Description: %s)",
            $threat->id, $threat->name, $threat->description));
        $threat->delete();
        return redirect()->route("threats.index")->with("status", __("Threat Deleted"));
    }
}
