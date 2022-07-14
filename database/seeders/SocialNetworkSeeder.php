<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialNetwork;

class SocialNetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $socialNetworks = [
            ['name' => 'Facebook'],
            ['name' => 'Twitter'],
            ['name' => 'LinkedIn'],
            ['name' => 'YouTube'],
            ['name' => 'Instagram'],
            ['name' => 'TikTok']
        ];

        foreach ($socialNetworks as $name) {

            SocialNetwork::updateOrCreate($name, $name);

        }
    }
}
