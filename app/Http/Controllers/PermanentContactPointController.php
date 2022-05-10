<?php

namespace App\Http\Controllers;

use App\Exports\PermanentContactPointExport;
use App\Models\PermanentContactPoint;
use App\Http\Requests\StorePermanentContactPointRequest;
use App\Http\Requests\UpdatePermanentContactPointRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PermanentContactPointController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(PermanentContactPoint::class, 'permanent_contact_point');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|BinaryFileResponse
     */
    public function index(Request $request)
    {
        if ($request->has("export")) {
            return Excel::download(new PermanentContactPointExport, config("constants.exports.permanent_contact_point_file_name"));
        }
        $permanentContactPoints = PermanentContactPoint::all();
        return view("permanent-contact-point.index", ["permanentContactPoints" => $permanentContactPoints]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view("permanent-contact-point.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePermanentContactPointRequest $request
     * @return RedirectResponse
     */
    public function store(StorePermanentContactPointRequest $request)
    {
        $validated = $request->validated();
        $permanent_contact_point = new PermanentContactPoint;
        $permanent_contact_point->fill([
            "entity_name" => $request->input("entity_name"),
            "permanent_contact_point_name" => $request->input("permanent_contact_point_name"),
            "main_email_address" => $request->input("main_email_address"),
            "secondary_email_address" => $request->input("secondary_email_address"),
            "main_landline_phone_number" => $request->input("main_landline_phone_number"),
            "secondary_landline_phone_number" => $request->input("secondary_landline_phone_number"),
            "main_mobile_phone_number" => $request->input("main_mobile_phone_number"),
            "secondary_mobile_phone_number" => $request->input("secondary_mobile_phone_number"),
            "other_alternative_contacts" => $request->input("other_alternative_contacts"),
        ]);
        $permanent_contact_point->save();
        Log::info(sprintf("[%s] [Create Permanent Contact Point with ID %s] [%s]", $request->user()->email, $permanent_contact_point->id, $request->ip()));
        return redirect()->route("permanent-contact-point.index")->with("status", "Permanent Contact Point Created");
    }

    /**
     * Display the specified resource.
     *
     * @param PermanentContactPoint $permanentContactPoint
     * @return RedirectResponse
     */
    public function show(PermanentContactPoint $permanentContactPoint)
    {
        return redirect()->route("permanent-contact-point.edit", $permanentContactPoint);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PermanentContactPoint $permanentContactPoint
     * @return Application|Factory|View
     */
    public function edit(PermanentContactPoint $permanentContactPoint)
    {
        return view("permanent-contact-point.edit", ["permanent_contact_point" => $permanentContactPoint]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdatePermanentContactPointRequest $request
     * @param PermanentContactPoint $permanentContactPoint
     * @return RedirectResponse
     */
    public function update(UpdatePermanentContactPointRequest $request, PermanentContactPoint $permanentContactPoint)
    {
        $validated = $request->validated();
        $permanentContactPoint->update(
            [
                "entity_name" => $request->input("entity_name"),
                "permanent_contact_point_name" => $request->input("permanent_contact_point_name"),
                "main_email_address" => $request->input("main_email_address"),
                "secondary_email_address" => $request->input("secondary_email_address"),
                "main_landline_phone_number" => $request->input("main_landline_phone_number"),
                "secondary_landline_phone_number" => $request->input("secondary_landline_phone_number"),
                "main_mobile_phone_number" => $request->input("main_mobile_phone_number"),
                "secondary_mobile_phone_number" => $request->input("secondary_mobile_phone_number"),
                "other_alternative_contacts" => $request->input("other_alternative_contacts"),
            ]
        );
        Log::info(sprintf("[%s] [Update Permanent Contact Point with ID %s] [%s]", $request->user()->email, $permanentContactPoint->id, $request->ip()));
        return redirect()->route("permanent-contact-point.index")->with("status", "Permanent Contact Point Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PermanentContactPoint $permanentContactPoint
     * @return RedirectResponse
     */
    public function destroy(Request $request, PermanentContactPoint $permanentContactPoint)
    {
        Log::info(sprintf("[%s] [Delete Permanent Contact Point with ID %s] [%s]", $request->user()->email, $permanentContactPoint->id, $request->ip()));
        $permanentContactPoint->delete();
        return redirect()->route("permanent-contact-point.index")->with("status", "Permanent Contact Point Deleted");
    }
}
