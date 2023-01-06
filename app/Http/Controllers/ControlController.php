<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreControlRequest;
use App\Http\Requests\UpdateControlRequest;
use App\Models\Control;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    public function index(Request $request)
    {
        $filter = $request->input("filter", "");
        if (!empty($filter)) {
            $controls = Control::where("name", "like", "%" . $filter . "%")->
            orWhere("description", "like", "%" . $filter . "%")->
            paginate(5)->withQueryString();
        }
        else {
            $controls = Control::paginate(5)->withQueryString();
        }
        return view("controls.index", ["controls" => $controls, "filter" => $filter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view("controls.create");
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
        $control = new Control;
        $control->fill([
            "name" => $name,
            "description" => $description
        ]);
        $control->save();
        Log::channel("application")->info(sprintf("Create Control %d (Name: %s, Description: %s)", $control->id, $control->name, $control->description));

        return redirect()->route("controls.index")->with("status", __("Control Created"));

    }

    /**
     * Display the specified resource.
     *
     * @param Control $control
     * @return Application|Factory|View
     */
    public function show(Control $control)
    {
        return view("controls.show", ["control" => $control]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Control $control
     * @return Application|Factory|View
     */
    public function edit(Control $control)
    {
        return view("controls.edit", ["control" => $control]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateControlRequest $request
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
        Log::channel("application")->info(sprintf("Update Control %d (Name: %s, Description: %s)", $control->id, $control->name, $control->description));
        return redirect()->route("controls.index")->with("status", __("Control Updated"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Control $control
     * @return RedirectResponse
     */
    public function destroy(Control $control)
    {
        Log::channel("application")->info(sprintf("Delete Control %d (Name: %s, Description: %s)", $control->id, $control->name, $control->description));
        $control->delete();
        return redirect()->route("controls.index")->with("status", __("Control Deleted"));
    }
}
