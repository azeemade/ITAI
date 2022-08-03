<?php

namespace Database\Seeders;

use App\Enums\MaintenanceStatus;
use App\Enums\Priority;
use App\Enums\ServiceType;
use App\Models\Asset;
use App\Models\Maintenance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 25; $i++) {
            Maintenance::create([
                'subject' => $faker->word(),
                'description' => $faker->paragraph(1),
                'asset_id' => $this->getAsset(),
                'status' => $faker->randomElement($array = MaintenanceStatus::getKeys()),
                'priority' => $faker->randomElement($array = Priority::getKeys()),
                'service_type' => $faker->randomElement($array = ServiceType::getKeys()),
                'staff_id' => $faker->randomNumber(4, true),
                'serviced_by' => $faker->company(),
                'repaired_on' => $faker->dateTime(),
                'comment' => $faker->sentence(9),
            ]);
        }
    }

    public function getAsset()
    {
        $dpt = Asset::inRandomOrder()->first();

        return $dpt->id;
    }
}
