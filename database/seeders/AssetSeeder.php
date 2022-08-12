<?php

namespace Database\Seeders;

use App\Models\Asset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\Disposition;
use App\Enums\Functionality;
use App\Enums\Status;
use App\Models\User;
use App\Models\Category;
use App\Models\Department;
use App\Models\Location;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 25; $i++) {
            Asset::create([
                'name' => $faker->word(),
                'brand' => $faker->company(),
                'model' => $faker->word(),
                'serial_number' => $faker->randomNumber(9, true),
                'disposition' => $faker->randomElement($array = Disposition::getKeys()),
                'status' => $faker->randomElement($array = Status::getKeys()),
                'user_id' => '1',
                'department_id' => $this->getDepartment(),
                'location_id' => $this->getLocation(),
                'category_id' => $this->getCategory(),
                'functionality' => $faker->randomElement($array = Functionality::getKeys()),
                'note'   => $faker->paragraph(2)
            ]);
        }
    }

    public function getDepartment()
    {
        $dpt = Department::inRandomOrder()->first();

        return $dpt->id;
    }

    public function getLocation()
    {
        $lct = Location::inRandomOrder()->first();

        return $lct->id;
    }

    public function getCategory()
    {
        $ctg = Category::inRandomOrder()->first();

        return $ctg->id;
    }
}
