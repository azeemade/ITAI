<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'staff_id' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'department_id' => 'required',
            'location_id' => 'required'
        ]);

        $staff = Staff::updateOrCreate([
            'id' => $request->id,
        ], [
            'staff_id' => $request->staff_id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'department_id' => $request->department_id,
            'location_id' => $request->location_id
        ]);


        return response()->json([
            'status' => (bool) $staff,
            'message' => $staff ? 'Staff created succesfully!' : 'Error creating staff'
        ]);
        // return array
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }

    public function checkStaffID(Request $request)
    {
        if (Staff::where('staff_id', $request->staff_id)->count() > 0) {
            return response()->json([
                'status' => 'Success',
                'message' => 'ID is available.'
            ]);
        }

        return response()->json([
            'status' => 'Error',
            'message' => 'ID not available.'
        ]);
    }
}
