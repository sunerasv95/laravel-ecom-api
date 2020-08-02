<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            "name" => "Electronics",
            "status" => 1,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s")
        ]);

        DB::table('categories')->insert([
            "name" => "Sports",
            "status" => 1,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s")
        ]);

        DB::table('categories')->insert([
            "name" => "Fashion",
            "status" => 1,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s")
        ]);

        DB::table('categories')->insert([
            "name" => "Home & Decor",
            "status" => 1,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s")
        ]);

        DB::table('categories')->insert([
            "name" => "Motor",
            "status" => 1,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s")
        ]);

        DB::table('categories')->insert([
            "name" => "Health $ Beauty",
            "status" => 1,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s")
        ]);

        DB::table('categories')->insert([
            "name" => "Other",
            "status" => 1,
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s")
        ]);
    }
}
