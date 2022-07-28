<?php

namespace App\Http\Controllers;

use App\Enums\Disposition;
use App\Enums\Functionality;
use App\Enums\MaintenanceStatus;
use App\Enums\Priority;
use App\Enums\ServiceType;
use App\Enums\Status;
use App\Models\Asset;
use App\Models\Assets_staff;
use App\Models\Category;
use App\Models\Department;
use App\Models\Location;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = Asset::all();
        $departments = Department::all();
        $categories = Category::all();

        return view("pages.assets.index")
            ->with(
                array(
                    'assets' => $assets,
                    'departments' => $departments,
                    'categories' => $categories
                )
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $disposition = Disposition::getKeys();
        $functionality = Functionality::getKeys();
        $status = Status::getKeys();
        $department = Department::all();
        $location = Location::all();
        $category = Category::all();

        return view("pages.assets.create")
            ->with(
                array(
                    'disposition' => $disposition,
                    'status' => $status,
                    'functionality' => $functionality,
                    'department' => $department,
                    'location' => $location,
                    'category' => $category
                )
            );
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
            'name' => 'required',
            'brand' => 'required',
            'status' => 'required'
        ]);

        $fileName = $this->uploadImage($request);
        $id = $this->generateId($request);

        $asset = Asset::updateOrCreate([
            'id' => $request->id,
        ], [
            'id' => $id,
            'name' => $request->name,
            'brand' => $request->brand,
            'model' => $request->model,
            'serial_number' => $request->serialnumber,
            'tag' => $request->tag,
            'note' => $request->note,
            'others' => $request->others,
            'user_id' => 1,
            'image' => $fileName,
            'status' => $request->status,
            'location_id' => $request->location,
            'department_id' => $request->department,
            'disposition' => $request->disposition,
            'category_id' => $request->category,
            'functionality' => $request->functionality,
        ]);

        $assets_staff = $this->updateOrCreateAssets_staff($request, $asset);

        if (!$assets_staff) {
            return back()->withInput()
                ->with('status', 'Asset not attached to staff(s) , error occured');
        }

        return redirect()->route('assets')
            ->with('status', 'Asset created!');
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

    public function updateOrCreateAssets_staff(Request $request, $asset)
    {
        foreach ($request->staff_id as $staff_id) {
            $asset = Assets_staff::updateOrCreate([
                'id' => $request->id,
            ], [
                'staff_id' => $staff_id,
                'asset_id' => $asset->id
            ]);
        }

        return $asset;
    }

    public function generateId(Request $request)
    {
        $permittedStrings = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $res = $request->location . $request->department . $request->category . substr(str_shuffle($permittedStrings), 0, 4);
        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset)
    {
        return view("pages.assets.view", compact('asset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset)
    {
        return view("pages.assets.edit", compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset)
    {
        //
    }

    public function filter(Request $request)
    {
        if ($request->ajax()) {
            $output = "";

            $assets = Asset::when(
                isset($request->search),
                function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->search . "%")
                        ->orWhere('brand', 'LIKE', '%' . $request->search . "%");
                }
            )
                ->when(
                    isset($request->category),
                    function ($query) use ($request) {
                        if ($request->category == "All") {
                            $query;
                        } else {
                            $query->where('category_id', $request->category);
                        }
                    }
                )
                ->when(
                    isset($request->department),
                    function ($query) use ($request) {
                        if ($request->category == "All") {
                            $query;
                        } else {
                            $query->where('department_id', $request->categdepartmentory);
                        }
                    }
                )->get();

            if ($assets) {
                foreach ($assets as $key => $asset) {
                    $output .= '<tr>' .
                        '<td class="pl-3">' . $asset->id . '</td>' .
                        '<td>' . $asset->name . '</td>' .
                        '<td>' . $asset->brand . '</td>' .
                        '<td>' . $asset->model . '</td>' .
                        '<td>' . $asset->serial_number . '</td>' .
                        '<td>' . $asset->status . '</td>' .
                        '<td>' . $asset->department->name . '</td>' .
                        '<td>' . $asset->category->name . '</td>' .
                        '<td>' . $asset->user_id . '</td>' .
                        '<td>' . \Carbon\Carbon::parse($asset->created_at)->format('j F Y') . '</td>' .
                        '</tr>';
                }

                return response()->json([
                    'status' => (bool) $output,
                    'data' => $output
                ]);
            }
        }
    }
}
