<?php

namespace App\Http\Controllers;

use App\Models\Control;
use App\Http\Requests\StoreControlRequest;
use App\Http\Requests\UpdateControlRequest;
use App\Models\Threat;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use function GuzzleHttp\Promise\all;

class ControlController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Control::class, 'control');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $controls = Control::all();
        return view("controls.index",["controls"=>$controls]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse
     */
    public function create()
    {
        //$threats = Threat::all();
        //return view("controls.create",["threats"=>$threats]);
        return redirect()->route("controls.index")->with("error","The Controls for a Threat Must be Created in the Threat Page");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreControlRequest $request
     * @return RedirectResponse
     */
    public function store(StoreControlRequest $request)
    {
        $validated = $request->validated();
        $name = $request->input("name");
        $description = $request->input("description");
        $threat_id = $request->input("threat");
        $control = new Control;
        $control->fill([
            "name"=>$name,
            "description" => $description,
            "threat_id" => $threat_id
        ]);
        $control->save();
        return redirect()->route("threats.edit",$threat_id)->with("status", "Control Created");

    }

    /**
     * Display the specified resource.
     *
     * @param Control $control
     * @return Application|Factory|View
     */
    public function show(Control $control)
    {
        return view("controls.show",$control);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Control $control
     * @return Application|Factory|View
     */
    public function edit(Control $control)
    {
        return view("controls.edit",["control"=>$control]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateControlRequest  $request
     * @param Control $control
     * @return RedirectResponse
     */
    public function update(UpdateControlRequest $request, Control $control)
    {
        $validated = $request->validated();
        $control->update([
            "name" => $request->input("name"),
            "description" => $request->input("description")
        ]);
        return redirect()->route("threats.edit",$control->threat_id)->with("status", "Control Updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Control $control
     * @return RedirectResponse
     */
    public function destroy(Control $control)
    {
        $control->delete();
        return redirect()->route("threats.edit",$control->threat_id)->with("status", "Control Deleted");
    }
}
