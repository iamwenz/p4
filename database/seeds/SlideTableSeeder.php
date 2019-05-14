<?php

use Illuminate\Database\Seeder;
use App\Slide;

class SlideTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      # Array of author data to add
      $slides = [
        ['Great News!', '1/May to 1/June', '20% discount on branded dog can food.', 'https://ak7.picdn.net/shutterstock/videos/11323817/thumb/3.jpg', true],
        ['Summer Break!', '8/JUL to 11/JUL', 'Clinic wil be closed for summer vacation.', 'https://images.all-free-download.com/images/graphiclarge/rippled_wall_background_01_hd_pictures_169887.jpg', true],
        ['Caustion', '', 'Don\'t forget to feed the heart warm medication for your dog.', 'http://www.textures4photoshop.com/tex/thumbs/triangles-low-poly-free-background-texture-56.jpg', true],
        ['Winter Sale', '20/Dec to 26/Dec', '20% discount on branded cat food and products.', 'https://images.all-free-download.com/images/graphiclarge/winter_background_311052.jpg', true],
      ];
      $count = count($slides);

      # Loop through each author, adding them to the database
      foreach ($slides as $slideData) {
        $slide = new Slide();

        $slide->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
        $slide->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
        $slide->title = $slideData[0];
        $slide->sub_title = $slideData[1];
        $slide->content = $slideData[2];
        $slide->background_url = $slideData[3];
        $slide->active = $slideData[4];
        $slide->save();

        $count--;
      }
    }
}
