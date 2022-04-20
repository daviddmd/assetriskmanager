<?php

namespace App\Http\Controllers;

use App\Models\Threat;
use App\Http\Requests\StoreThreatRequest;
use App\Http\Requests\UpdateThreatRequest;

class ThreatController extends Controller
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
     * @param  \App\Http\Requests\StoreThreatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreThreatRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Threat  $threat
     * @return \Illuminate\Http\Response
     */
    public function show(Threat $threat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Threat  $threat
     * @return \Illuminate\Http\Response
     */
    public function edit(Threat $threat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateThreatRequest  $request
     * @param  \App\Models\Threat  $threat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateThreatRequest $request, Threat $threat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Threat  $threat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Threat $threat)
    {
        //
    }
}
