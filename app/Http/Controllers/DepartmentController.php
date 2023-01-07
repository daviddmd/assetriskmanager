<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    //Authorizes all child routes of this controller with the department policies
    public function __construct()
    {
        $this->authorizeResource(Department::class, 'department');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $departments = Department::all();
        return view("departments.index", ["departments" => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view("departments.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDepartmentRequest $request
     * @return RedirectResponse
     */
    public function store(StoreDepartmentRequest $request)
    {
        $name = $request->input("name");
        $description = $request->input("description");
        $department = new Department;
        $department->fill(["name" => $name, "description" => $description]);
        $department->save();
        Log::channel("application")->info(sprintf("Create Department %d (Name: %s, Description: %s)", $department->id, $department->name, $department->description));
        return redirect()->route("departments.index")->with("status", __("Department Created"));
    }

    /**
     * Display the specified resource.
     *
     * @param Department $department
     * @return Application|Factory|View
     */
    public function show(Department $department)
    {
        return view("departments.show", ["department" => $department]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Department $department
     * @return Application|Factory|View
     */
    public function edit(Department $department)
    {
        return view("departments.edit", ["department" => $department]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDepartmentRequest $request
     * @param Department $department
     * @return RedirectResponse
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update(["name" => $request->input("name"), "description" => $request->input("description")]);
        Log::channel("application")->info(sprintf("Update Department %d (Name: %s, Description: %s)", $department->id, $department->name, $department->description));
        return redirect()->route("departments.index")->with("status", __("Department Updated"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Department $department
     * @return RedirectResponse
     */
    public function destroy(Department $department)
    {
        Log::channel("application")->info(sprintf("Delete Department %d (Name: %s, Description: %s)", $department->id, $department->name, $department->description));
        $department->delete();
        return redirect()->route("departments.index")->with("status", __("Department Deleted"));
    }
}
