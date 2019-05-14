<?php

use Illuminate\Database\Seeder;
use App\Appointment;
use App\Veterinarian;

class AppointmentVeterinarianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      # Now loop through the above array, creating a new pivot for each book to tag

      $appointments = Appointment::all();
      $vets = veterinarian::all();
      $vetSize = count($vets);

      foreach ($appointments as $appointment) {
        $random = mt_rand(0, $vetSize-1);
        $vet = $vets->get($random);
        $appointment->veterinarians()->save($vet);
      }
    }
}
