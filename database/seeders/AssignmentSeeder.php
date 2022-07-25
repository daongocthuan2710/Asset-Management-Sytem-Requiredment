<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Assignment;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assignment::create(["asset_id" => "3", "admin_id" => 2, "staff_id" => 10, "assign_date" => "2022-02-20", "state" => 0]);
        Assignment::create(["asset_id" => "5", "admin_id" => 7, "staff_id" => 12, "assign_date" => "2021-12-29", "state" => 1]);
        Assignment::create(["asset_id" => "6", "admin_id" => 20, "staff_id" => 6, "assign_date" => "2020-10-10", "state" => -1]);
    }
}
