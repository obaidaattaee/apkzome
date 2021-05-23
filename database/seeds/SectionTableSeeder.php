<?php

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = Section::SECTIONS;
        foreach ($sections as $section) {
            Section::create($section);
        }
    }
}
