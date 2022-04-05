<?php

namespace App\Http\Controllers;

use App\Models\ClassDay;
use App\Http\Requests\StoreClassDayRequest;
use App\Http\Requests\UpdateClassDayRequest;

class ClassDayController extends Controller
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
     * @param  \App\Http\Requests\StoreClassDayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassDayRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassDay  $classDay
     * @return \Illuminate\Http\Response
     */
    public function show(ClassDay $classDay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassDay  $classDay
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassDay $classDay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassDayRequest  $request
     * @param  \App\Models\ClassDay  $classDay
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassDayRequest $request, ClassDay $classDay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassDay  $classDay
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassDay $classDay)
    {
        //
    }
}
