<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Asset;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Asset::create(["name" => "Laptop 10", "category_id" => "LP", "installed_date" => "2016-06-11", "state" => -2, "location" => "HN"]);
        Asset::create(["name" => "Monitor 3", "category_id" => "MO", "installed_date" => "2011-08-08", "state" => 1, "location" => "HCM"]);
        Asset::create(["name" => "PC 1", "category_id" => "PC", "installed_date" => "2019-02-07", "state" => 2, "location" => "DN"]);
        Asset::create(["name" => "Laptop 09", "category_id" => "LP", "installed_date" => "2022-08-09", "state" => -1, "location" => "DN"]);
        Asset::create(["name" => "Monitor 2", "category_id" => "MO", "installed_date" => "2011-11-02", "state" => 2, "location" => "HN"]);
        Asset::create(["name" => "PC 2", "category_id" => "PC", "installed_date" => "2002-08-01", "state" => 0, "location" => "HCM"]);
    }
}
