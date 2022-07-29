<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Department;
use App\Models\Location;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AssetSeeder::class,
        ]);

        // $file = Storage::disk('public')->get("seed/db.json");
        // $db = json_decode($file);
        // foreach ($db as $key => $value) {
        //     if ($value->tableName == "Categories") {
        //         foreach ($value->data as $key => $val) {
        //             Category::create([
        //                 "name" => $val->name,
        //                 "properties" => []
        //             ]);
        //         }
        //     } elseif ($value->tableName == "Departments") {
        //         foreach ($value->data as $key => $val) {
        //             Department::create([
        //                 "name" => $val->name,
        //                 "location_id" => $val->location_id
        //             ]);
        //         }
        //     } elseif ($value->tableName == "Staffs") {
        //         foreach ($value->data as $key => $val) {
        //             Staff::create([
        //                 "staff_id" => $val->staff_id,
        //                 "firstname" => $val->firstname,
        //                 "lastname" => $val->lastname,
        //                 "department_id" => $val->department_id,
        //                 "location_id" => $val->location_id
        //             ]);
        //         }
        //     } else {
        //         foreach ($value->data as $key => $val) {
        //             Location::create([
        //                 "name" => $val->name
        //             ]);
        //         }
        //     }
        // }
    }
}
