<?php

namespace App\Http\Controllers;

use App\Models\Cicle;
use App\Http\Requests\StoreCicleRequest;
use App\Http\Requests\UpdateCicleRequest;

class CicleController extends Controller
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
     * @param  \App\Http\Requests\StoreCicleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCicleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cicle  $cicle
     * @return \Illuminate\Http\Response
     */
    public function show(Cicle $cicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cicle  $cicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Cicle $cicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCicleRequest  $request
     * @param  \App\Models\Cicle  $cicle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCicleRequest $request, Cicle $cicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cicle  $cicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cicle $cicle)
    {
        //
    }
}
