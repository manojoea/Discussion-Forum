<?php

use Illuminate\Database\Seeder;
use App\Channel;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1 = ['title' => 'Laravel', 'slug' => str_slug('Laravel')];
        $channel2 = ['title' => 'VueJs', 'slug' => str_slug('VueJs')];
        $channel3 = ['title' => 'PHP', 'slug' => str_slug('PHP')];
        $channel4 = ['title' => 'CSS', 'slug' => str_slug('CSS')];
        $channel5 = ['title' => 'Javascript', 'slug' => str_slug('Javascript')];
        $channel6 = ['title' => 'MySQL', 'slug' => str_slug('MySQL')];
        $channel7 = ['title' => 'Bootstrap', 'slug' => str_slug('Bootstrap')];
        $channel8 = ['title' => 'HTML', 'slug' => str_slug('HTML')];

        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
        Channel::create($channel5);
        Channel::create($channel6);
        Channel::create($channel7);
        Channel::create($channel8);
    }
}
