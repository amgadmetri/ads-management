<?php

namespace Database\Factories;

use App\Models\Advertisement;
use App\Models\Advertiser;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertisementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Advertisement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'         => $this->faker->text(20),
            'description'   => $this->faker->text(150),
            'advertiser_id' => Advertiser::factory(),
            'category_id'   => Category::factory(),
            'start_date'    => Carbon::today()->addDays(rand(1, 14))
        ];
    }
}
