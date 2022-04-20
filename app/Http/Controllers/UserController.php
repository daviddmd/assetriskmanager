<?php
namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\Department;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $filter = $request->input("filter","");
        $department_id = $request->input("department","");
        if (!empty($filter) || !empty($department_id)){
            if (!empty($department_id)){
                $users = User::where("department_id",$department_id)->where(function ($query) use ($filter){
                    $query->where("name","like","%".$filter."%")->orWhere("email","like","%".$filter."%");
                })->paginate(5)->withQueryString();
            }
            else{
                $users = User::where("name","like","%".$filter."%")->orWhere("email","like","%".$filter."%")->paginate(5)->withQueryString();
            }
        }
        else{
            $users = User::paginate(5)->withQueryString();
        }
        $departments = Department::all();
        return view("users.index", ["users" => $users,"departments"=>$departments,"filter"=>$filter,"department_id"=>$department_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse
     */
    public function create()
    {
        return redirect()->route("users.index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        return redirect()->route("users.index");
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
        $departments = Department::all();
        return view("users.show", ["user" => $user,"departments"=>$departments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        //TODO add list of assets
        $departments = Department::all();
        return view("users.edit", ["user" => $user,"departments"=>$departments]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();
        $user->update([
            "name" => $request->input("name"),
            "department_id" => $request->input("department"),
            "active" => $request->has("active"),
            "role"=>$user->role == UserRole::ADMINISTRATOR ? $request->input("role") : $user->role,
        ]);
        return redirect()->route("users.index")->with("status", "User Updated, status of active: " . var_export($request->has("active"),true));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        return redirect()->route("users.index");
    }
}
