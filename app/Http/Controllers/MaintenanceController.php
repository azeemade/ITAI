<?php

namespace App\Http\Controllers;

use App\Enums\MaintenanceStatus;
use App\Enums\maintenancetatus;
use App\Enums\Priority;
use App\Enums\ServiceType;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maintenance = Maintenance::all();
        return view("pages.maintenance.index", compact('maintenance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $priority = Priority::getKeys();
        $status = MaintenanceStatus::getKeys();
        $serviceType = ServiceType::getKeys();

        return view("pages.maintenance.create")
            ->with(
                array(
                    'priority' => $priority,
                    'status' => $status,
                    'serviceType' => $serviceType
                )
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $asset)
    {

        $validatedData = $request->validate([
            'subject' => 'required',
            'description' => 'required',
            'service_type' => 'required',
            'priority' => 'required'
        ]);

        $fileName = $this->uploadImage($request);
        $id = $this->generateId($request);

        $maintenance = Maintenance::updateOrCreate([
            'id' => $asset->id,
        ], [
            'id' => $id,
            'subject' => $request->subject,
            'description' => $request->description,
            'status' => $request->status,
            'asset_id' => $asset->id,
            'service_type' => $request->service_type,
            'staff_id' => $request->staff_id,
            'serviced_by' => $request->serviced_by,
            'repaired_at' => $request->repaired_at,
            'comment' => $request->comment,
            'priority' => $request->priority,
            'image' => $fileName,
        ]);

        return redirect()->route('maintenance')
            ->with('status', 'Issue logged!');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileName = 'image' . '_' . $request->name . '_' . $request->brand . '_' . date("Y-m-d") . '.' . $fileExt;
            $request->file('image')->move(public_path('images'), $fileName);
            return $fileName;
        }
    }

    public function generateId(Request $request)
    {
        $permittedStrings = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $res = substr(str_shuffle($permittedStrings), 0, 5);
        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function show(Maintenance $maintenance)
    {
        return view("pages.maintenance.view", compact('maintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function edit(Maintenance $maintenance)
    {
        return view("pages.maintenance.edit", compact('maintenance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maintenance $maintenance)
    {
        //
    }
}
