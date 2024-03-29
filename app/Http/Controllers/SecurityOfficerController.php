<?php

namespace App\Http\Controllers;

use App\Exports\SecurityOfficerExport;
use App\Http\Requests\StoreSecurityOfficerRequest;
use App\Http\Requests\UpdateSecurityOfficerRequest;
use App\Models\SecurityOfficer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SecurityOfficerController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(SecurityOfficer::class, 'security_officer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|BinaryFileResponse
     */
    public function index(Request $request)
    {
        if ($request->has("export")) {
            return Excel::download(new SecurityOfficerExport, config("constants.exports.security_officer_file_name"));
        }
        $securityOfficer = SecurityOfficer::first();
        if (empty($securityOfficer)) {
            return view("security-officer.create");
        }
        else {
            return view("security-officer.edit", ["security_officer" => $securityOfficer]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view("security-officer.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSecurityOfficerRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSecurityOfficerRequest $request)
    {
        $securityOfficer = new SecurityOfficer;
        $securityOfficer->fill([
            "entity_name" => $request->input("entity_name"),
            "name" => $request->input("name"),
            "role" => $request->input("role"),
            "email_address" => $request->input("email_address"),
            "landline_phone_number" => $request->input("landline_phone_number"),
            "mobile_phone_number" => $request->input("mobile_phone_number"),
        ]);
        $securityOfficer->save();
        Log::channel("application")->info(sprintf("Create Security Officer %d", $securityOfficer->id));
        return redirect()->route("security-officer.index")->with("status", __("Security Officer Created"));
    }

    /**
     * Display the specified resource.
     *
     * @param SecurityOfficer $securityOfficer
     * @return RedirectResponse
     */
    public function show(SecurityOfficer $securityOfficer)
    {
        return redirect()->route("security-officer.edit", $securityOfficer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param SecurityOfficer $securityOfficer
     * @return Application|Factory|View
     */
    public function edit(SecurityOfficer $securityOfficer)
    {
        return view("security-officer.edit", ["security_officer" => $securityOfficer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSecurityOfficerRequest $request
     * @param SecurityOfficer $securityOfficer
     * @return RedirectResponse
     */
    public function update(UpdateSecurityOfficerRequest $request, SecurityOfficer $securityOfficer)
    {
        $securityOfficer->update([
            "entity_name" => $request->input("entity_name"),
            "name" => $request->input("name"),
            "role" => $request->input("role"),
            "email_address" => $request->input("email_address"),
            "landline_phone_number" => $request->input("landline_phone_number"),
            "mobile_phone_number" => $request->input("mobile_phone_number"),
        ]);
        Log::channel("application")->info(sprintf("Update Security Officer %d", $securityOfficer->id));
        return redirect()->route("security-officer.index")->with("status", __("Security Officer Updated"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SecurityOfficer $securityOfficer
     * @return RedirectResponse
     */
    public function destroy(SecurityOfficer $securityOfficer)
    {
        Log::channel("application")->info(sprintf("Delete Security Officer %d", $securityOfficer->id));
        $securityOfficer->delete();
        return redirect()->route("security-officer.index")->with("status", __("Security Officer Deleted"));
    }
}
