<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(VeterinariansTableSeeder::class);
        $this->call(AppointmentsTableSeeder::class);
        $this->call(AppointmentVeterinarianTableSeeder::class);
        $this->call(SlideTableSeeder::class);
    }
}
