<?php

namespace Database\Seeders;

use App\Enums\Country;
use App\Models\Artist;
use App\Models\Event;
use App\Models\Venue;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 10; $i++) {
            $artist = Artist::create([
                'name'              => fake()->name(),
                'description_short' => fake()->realText(50),
                'description_long'  => fake()->realText(),
                'link_facebook'     => fake()->url(),
                'link_youtube'      => fake()->url(),
                'link_spotify'      => fake()->url(),
                'link_instagram'    => fake()->url(),
                'link_website'      => fake()->url(),
                'link_press'        => fake()->url(),
                'seo_title'         => fake()->text(10),
                'seo_description'   => fake()->text(69),
            ]);
            Venue::create([
                'name'      => fake()->userName(),
                'zipcode'   => fake()->postcode(),
                'city'      => fake()->city(),
                'country'   => Country::DENMARK,
                'latitude'  => fake()->latitude(),
                'longitude' => fake()->longitude(),
            ]);
            $event = Event::create([
                'title'           => fake()->userName(),
                'sub_title'       => fake()->userName(),
                'sale_start'      => fake()->dateTime(),
                'sale_end'        => fake()->dateTime(),
                'public'          => fake()->boolean(),
                'seo_title'       => fake()->userName(),
                'seo_description' => fake()->realText(),
            ]);
            $event->artists()->syncWithoutDetaching($artist);

        }
    }
}
