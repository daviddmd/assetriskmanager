<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
        //TODO nº de utilizadores de cada dpt na tabela. relacao de dependencia no modelo.
        $departments = Department::all();
        return view("departments.index",["departments"=>$departments]);
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
        $validated = $request->validated();
        $name = $request->input("name");
        $description = $request->input("description");
        $department = new Department;
        $department->fill(["name"=>$name,"description"=>$description]);
        $department->save();
        return redirect()->route("departments.index")->with("status","Department Created");
    }

    /**
     * Display the specified resource.
     *
     * @param Department $department
     * @return Application|Factory|View
     */
    public function show(Department $department)
    {
        //TODO potencialmente uma funcionalidade que conta o nº de utilizadores que um departamento tem para utilizadores normais e lista de utilizadores para um SO/admin.
        return view("departments.show",["department"=>$department]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Department $department
     * @return Application|Factory|View
     */
    public function edit(Department $department)
    {
        return view("departments.edit",["department"=>$department]);
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
        $validated = $request->validated();
        $department->update(["name"=>$request->input("name"),"description"=>$request->input("description")]);
        return redirect()->route("departments.index")->with("status","Department Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Department $department
     * @return RedirectResponse
     */
    public function destroy(Department $department)
    {
        //FIXME verificar primeiro se tem alguma dependência com algum utilizador, a ser feito quando utilizador tiver roles
        $department->delete();
        return redirect()->route("departments.index")->with("status","Department Deleted");
    }
}
