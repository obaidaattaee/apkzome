<?php

use Illuminate\Database\Seeder;

class CategoeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \App\Models\Category::truncate();
        \App\Models\Category::insert(\App\Models\Category::CATEGORIES);
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
    }
}
