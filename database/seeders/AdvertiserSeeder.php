<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\Advertiser;
use Illuminate\Database\Seeder;

class AdvertiserSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        Advertiser::factory()
        ->count(2)
        ->has(
            Advertisement::factory()
            ->count(2)
            ->hasCategory()
            ->hasTags(3)
            )
            ->create();
        }
    }
    