<?php

namespace App\Http\Controllers;

use App\Models\SecurityOfficer;
use App\Http\Requests\StoreSecurityOfficerRequest;
use App\Http\Requests\UpdateSecurityOfficerRequest;

class SecurityOfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSecurityOfficerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSecurityOfficerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SecurityOfficer  $securityOfficer
     * @return \Illuminate\Http\Response
     */
    public function show(SecurityOfficer $securityOfficer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SecurityOfficer  $securityOfficer
     * @return \Illuminate\Http\Response
     */
    public function edit(SecurityOfficer $securityOfficer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSecurityOfficerRequest  $request
     * @param  \App\Models\SecurityOfficer  $securityOfficer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSecurityOfficerRequest $request, SecurityOfficer $securityOfficer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SecurityOfficer  $securityOfficer
     * @return \Illuminate\Http\Response
     */
    public function destroy(SecurityOfficer $securityOfficer)
    {
        //
    }
}
