<?php

namespace App\Http\Controllers;

use App\Models\WorkOutschedule;
use Illuminate\Http\Request;

class WorkOutscheduleController extends Controller
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
    public function CreateSchedule(Request $request){


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkOutschedule  $workOutschedule
     * @return \Illuminate\Http\Response
     */
    public function show(WorkOutschedule $workOutschedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkOutschedule  $workOutschedule
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkOutschedule $workOutschedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkOutschedule  $workOutschedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkOutschedule $workOutschedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkOutschedule  $workOutschedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkOutschedule $workOutschedule)
    {
        //
    }
}
