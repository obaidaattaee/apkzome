<?php

use App\Models\Settings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'key' => 'logo',
                'value' => 'php6grkSF/G1dE0ddN7PPK9K4SNDfFjjorS77KTACfHlc9MvUj.jpg'
            ],[
                'key' => 'twitter',
                'value' => 'https://twitter.com'
            ],[
                'key' => 'facebook',
                'value' => 'https://facebook.com'
            ],[
                'key' => 'instagram',
                'value' => 'https://instagram.com'
            ],[
                'key' => 'linkedin',
                'value' => 'https://linkedin.com'
            ],[
                'key' => 'telegram',
                'value' => 'https://telegram.com'
            ],[
                'key' => 'address',
                'value' => 'Some text Here..Abc Road, Xyz New City'
            ],[
                'key' => 'mail',
                'value' => 'mail@mail.com'
            ],[
                'key' => 'phone',
                'value' => '(972) 598668882'
            ],
        ];

        Schema::disableForeignKeyConstraints();
        Settings::truncate();
        Settings::insert($settings);
        Schema::enableForeignKeyConstraints();
    }
}
