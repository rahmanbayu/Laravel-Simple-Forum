<?php

use App\Channel;
use Illuminate\Database\Seeder;

class ChannelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel1 = Channel::create([
            'name' => 'Laravel 7',
            'slug' => \Str::slug('Laravel 7')
        ]);
        $channel2 = Channel::create([
            'name' => 'Vue js 3',
            'slug' => \Str::slug('Vue js 3')
        ]);

        $channel3 = Channel::create([
            'name' => 'React js',
            'slug' => \Str::slug('React js')
        ]);

        $channel4 = Channel::create([
            'name' => 'Angular 3.4',
            'slug' => \Str::slug('Angular 3.4')
        ]);
    }
}
