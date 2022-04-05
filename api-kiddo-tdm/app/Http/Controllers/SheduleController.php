<?php

namespace App\Http\Controllers;

use App\Models\Shedule;
use App\Http\Requests\StoreSheduleRequest;
use App\Http\Requests\UpdateSheduleRequest;

class SheduleController extends Controller
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
     * @param  \App\Http\Requests\StoreSheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSheduleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shedule  $shedule
     * @return \Illuminate\Http\Response
     */
    public function show(Shedule $shedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shedule  $shedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Shedule $shedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSheduleRequest  $request
     * @param  \App\Models\Shedule  $shedule
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSheduleRequest $request, Shedule $shedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shedule  $shedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shedule $shedule)
    {
        //
    }
}
