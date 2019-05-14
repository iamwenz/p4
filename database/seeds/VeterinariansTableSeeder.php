<?php

use Illuminate\Database\Seeder;
use App\Veterinarian;

class VeterinariansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      # Array of author data to add
      $Veterinarians = [
        ['Gerald Fitzgerald', 'Harvard Uni. / 2 years, dfasdjfi', 32, 'male', 4],
        ['Sylvia Plath', 'Boston Uni. / 3 years, jfoisjfoisd', 29, 'female',5],
        ['Maya Angelou', 'Yale Uni. / 15 years, ifjsoijfoi', 45, 'female',5],
        ['Kelly Rowling', 'Columbia Uni. / 3 years, fdhoidsj', 33, 'female',3]
      ];
      $count = count($Veterinarians);

      # Loop through each author, adding them to the database
      foreach ($Veterinarians as $VeterinarianData) {
        $vet = new Veterinarian();

        $vet->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
        $vet->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
        $vet->vetName = $VeterinarianData[0];
        $vet->vetDegree = $VeterinarianData[1];
        $vet->vetAge = $VeterinarianData[2];
        $vet->vetGender = $VeterinarianData[3];
        $vet->vetExperience = $VeterinarianData[4];
        $vet->save();

        $count--;
      }
    }
}
