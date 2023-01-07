<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Department;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $filter = $request->input("filter", "");
        $department_id = $request->input("department", "");
        if (!empty($filter) || !empty($department_id)) {
            $users = $this->filterUser($filter);
            if (!empty($department_id)) {
                $users = $users->where("department_id", "=", $department_id);
            }
            $users = $users->paginate(5)->withQueryString();
        }
        else {
            $users = User::paginate(5)->withQueryString();
        }
        $departments = Department::all();
        return view("users.index", ["users" => $users, "departments" => $departments, "filter" => $filter, "department_id" => $department_id]);
    }

    public static function filterUser($filter)
    {
        return User::where(function ($query) use ($filter) {
            $query->where("name", "like", "%" . $filter . "%")->orWhere("email", "like", "%" . $filter . "%")->orWhere("id", "=", $filter);
        });
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
     * @param StoreUserRequest $request
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
        return view("users.show", ["user" => $user, "departments" => $departments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        $departments = Department::all();
        return view("users.edit", ["user" => $user, "departments" => $departments]);
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
        $user->update([
            "name" => $request->input("name"),
            "department_id" => $request->input("department"),
            "active" => $request->has("active"),
            "role" => Auth::user()->role == UserRole::ADMINISTRATOR ? $request->input("role") : $user->role,
        ]);
        Log::channel("application")->info(sprintf("Update User %d (Name: %s, E-Mail: %s, Department: %s)", $user->id, $user->name, $user->email, empty($user->department) ? "" : $user->department->name));
        return redirect()->route("users.index")->with("status", __("User Updated"));
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
