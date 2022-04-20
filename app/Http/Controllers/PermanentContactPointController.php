<?php

namespace App\Http\Controllers;

use App\Models\PermanentContactPoint;
use App\Http\Requests\StorePermanentContactPointRequest;
use App\Http\Requests\UpdatePermanentContactPointRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class PermanentContactPointController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(PermanentContactPoint::class, 'permanent_contact_point');
    }

    /**
     * Display a listing of the resource.
     *
     * @return RedirectResponse
     */
    public function index()
    {
        $permanent_contact_point = PermanentContactPoint::first();
        if (empty($permanent_contact_point)) {
            return redirect()->route("permanent-contact-point.create");
        } else {
            return redirect()->route("permanent-contact-point.edit", $permanent_contact_point);

        }
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
        $permanet_contact_point = new PermanentContactPoint;
        $permanet_contact_point->fill([
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
        $permanet_contact_point->save();
        return redirect()->route("dashboard")->with("status", "Permanent Contact Point Created");
    }

    /**
     * Display the specified resource.
     *
     * @param PermanentContactPoint $permanentContactPoint
     */
    public function show(PermanentContactPoint $permanentContactPoint)
    {
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=permanent_contact_point.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
        $columns = array(
            'Entity Name',
            'Permanent Contact Point Name',
            'Main Email Address',
            'Secondary Email Address',
            'Main Landline Phone Number',
            'Secondary Landline Phone Number',
            'Main Mobile Phone Number',
            'Secondary Mobile Phone Number',
            'Other Alternative Contacts'
        );
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);
        fputcsv($file, array(
            $permanentContactPoint->entity_name,
            $permanentContactPoint->permanent_contact_point_name,
            $permanentContactPoint->main_email_address,
            $permanentContactPoint->secondary_email_address,
            $permanentContactPoint->main_landline_phone_number,
            $permanentContactPoint->secondary_landline_phone_number,
            $permanentContactPoint->main_mobile_phone_number,
            $permanentContactPoint->secondary_mobile_phone_number,
            $permanentContactPoint->other_alternative_contacts,
        ));
        fclose($file);
        return Response::stream($file, 200, $headers);

        //return redirect()->route("permanent-contact-point.edit", $permanentContactPoint);
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
        return redirect()->route("dashboard")->with("status", "Permanent Contact Point Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PermanentContactPoint $permanentContactPoint
     * @return Response
     */
    public function destroy(PermanentContactPoint $permanentContactPoint)
    {
        //
    }
}
