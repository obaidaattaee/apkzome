<?php

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sliders = [
            [
                'image' => 'phpzMzqqi/twlqtwycAe8gYaUSEYlNb1m4h6NYF3ic5XpPH67t.jpg',
                'image_title' =>[
                    'en' => 'slider 1'
                ],
                'image_alt' =>[
                    'en' => 'slider 1'
                ],
                'on_server' => true,

            ],
            [
                'image' => 'phpZOX7L0/2PQBg300HLNeKpDIeclgAL0LKuJ7NNWLVas6wPsq.png',
                'image_title' =>[
                    'en' => 'slider 2'
                ],
                'image_alt' =>[
                    'en' => 'slider 2'
                ],
                'on_server' => true,
            ],
            [
                'image' => 'phpyBdkP0/10C5oLg0byHc76HvxDMOS0rHWkLNzgqsHl89Mugj.jpg',
                'image_title' =>[
                    'en' => 'slider 1'
                ],
                'image_alt' =>[
                    'en' => 'slider 1'
                ],
                'on_server' => true,

            ],
            [
                'image' => 'phpVL82N2/josjLSKZDUiNssawdpZgkMLUPMMLUDBs1EUUelRI.png',
                'image_title' =>[
                    'en' => 'slider 1'
                ],
                'image_alt' =>[
                    'en' => 'slider 1'
                ],
                'on_server' => true,

            ],
        ];
        foreach ($sliders as $slider){
            Slider::create($slider);
        }
    }
}
