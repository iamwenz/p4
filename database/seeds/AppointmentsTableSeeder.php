<?php

use Illuminate\Database\Seeder;
use App\Appointment;
use App\User;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $year = Carbon\Carbon::now()->year;
      $month = Carbon\Carbon::now()->month;

      $appointments = [
        [$year.'/'.$month.'/13 10:00:00','Loki','dog','Yorkshire Terrier','2014','male','Sleeping a lot'],
        [$year.'/'.$month.'/13 12:00:00','Cap','dog','Yorkshire Terrier','2013','male','crying a lot'],
        [$year.'/'.$month.'/13 14:00:00','Yana','dog','Yorkshire Terrier','2011','female','running a lot'],
        [$year.'/'.$month.'/13 18:00:00','Kuma','dog','Yorkshire Terrier','2015','male','Sleeping a lot'],
        [$year.'/'.$month.'/15 12:00:00','Adam','dog','Golden Retriever','2000','male','red eyes and constant tearing'],
        [$year.'/'.$month.'/15 18:00:00','Adam','cat','Bohemian','2000','male','red eyes and constant tearing'],
        [$year.'/'.$month.'/16 14:00:00','Lucky','cat','Hybrid','2015','female','Sleeping a lot'],
        [$year.'/'.$month.'/16 10:00:00','Bell','dog','Husky','2014','male','eating its own defecate too much'],
        [$year.'/'.$month.'/17 08:00:00','Puma','cat','Hybrid','2017','female','Sleeping a lot'],
        [$year.'/'.$month.'/18 10:00:00','Lemon','bird','parrot','2015','female','Shedding constantly, no appetite'],
      ];

      $count = count($appointments);

      $users = User::all();


      foreach ($appointments as $key => $appointmentsData) {
        $random = mt_rand(0, 4);

        $appointment = new Appointment();

        $appointment->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
        $appointment->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
        $appointment->user_id = $users->get($random)->id;
        $appointment->appointment_time = $appointmentsData[0];
        $appointment->pet_name = $appointmentsData[1];
        $appointment->species = $appointmentsData[2];
        $appointment->breed = $appointmentsData[3];
        $appointment->birth_year = $appointmentsData[4];
        $appointment->gender = $appointmentsData[5];
        $appointment->symptom = $appointmentsData[6];
        $appointment->save();
        $count--;
      }

    }
}
