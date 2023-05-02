<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\SocialNetwork;
use Illuminate\Database\Seeder;

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
            ['name' => 'TikTok'],
        ];

        foreach ($socialNetworks as $name) {
            SocialNetwork::updateOrCreate($name, $name);
        }
    }
}
