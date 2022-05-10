<?php

namespace App\Http\Controllers;

use App\Models\Threat;
use App\Http\Requests\StoreThreatRequest;
use App\Http\Requests\UpdateThreatRequest;
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
            $threats = Threat::where("name", "like", "%" . $filter . "%")->
            orWhere("description", "like", "%" . $filter . "%")->
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
        $validated = $request->validated();
        $name = $request->input("name");
        $description = $request->input("description");
        $threat = new Threat;
        $threat->fill(["name" => $name, "description" => $description]);
        $threat->save();
        Log::info(sprintf("[%s] [Create Threat with ID %s (Name: %s, Description: %s)] [%s]", $request->user()->email, $threat->id, $threat->name, $threat->description, $request->ip()));
        return redirect()->route("threats.index")->with("status", "Threat Created");
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
        $validated = $request->validated();
        $threat->update(
            [
                "name" => $request->input("name"),
                "description" => $request->input("description")
            ]
        );
        Log::info(sprintf("[%s] [Update Threat with ID %s (Name: %s, Description: %s)] [%s]", $request->user()->email, $threat->id, $threat->name, $threat->description, $request->ip()));
        return redirect()->route("threats.index")->with("status", "Threat Updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Threat $threat
     * @return RedirectResponse
     */
    public function destroy(Request $request, Threat $threat)
    {
        Log::info(sprintf("[%s] [Delete Threat with ID %s (Name: %s, Description: %s)] [%s]", $request->user()->email, $threat->id, $threat->name, $threat->description, $request->ip()));
        $threat->delete();
        return redirect()->route("threats.index")->with("status", "Threat Deleted");
    }
}
