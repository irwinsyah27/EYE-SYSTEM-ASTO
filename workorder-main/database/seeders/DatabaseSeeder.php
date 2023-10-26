<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::insert([
            'name' => 'Administrator',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('secret'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Department::insert([
            [
                'name' => 'Sales & Marketing',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Purchasing',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Production',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Accounting',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'IT (Information & Technology)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        Company::insert([
            [
                'name' => 'PT. Asmin Bara Bronang',
                'address' => 'Jalan Kapten Naseh Blk No 73',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        Unit::insert([
            [
                "unit" => "CM0030",
                "egi" => "COMPRESOR",
                "type" => "COMPRESOR",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "unit" => "CM0059",
                "egi" => "COMPRESOR",
                "type" => "COMPRESOR",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "unit" => "CT0008",
                "egi" => "P380CB6X4",
                "type" => "CRANE TRUCK",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "unit" => "CT0017",
                "egi" => "P380CB6X4",
                "type" => "CRANE TRUCK",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "unit" => "CR0012",
                "egi" => "CRUSHER",
                "type" => "CRUSHER",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "unit" => "FR0601",
                "egi" => "FORKLIFT",
                "type" => "FORKLIFT",
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ]);

    }
}
