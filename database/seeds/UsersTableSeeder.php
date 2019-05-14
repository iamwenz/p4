<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      # Array of author data to add
      $users = [
        ['Gerald', 'Fitzgerald', 'gf21@gmail.com', '12332121', '432 main st. Boston MA', '12345678'],
        ['Sylvia', 'Plath', 'sp12@gmail.com', '12332121','232 Lincon Ave. Lehigh Valley PA', '12345678'],
        ['Maya', 'Angelou', 'ma43@gmail.com', '12332121','222 6th Ave. New York City NY', '12345678'],
        ['Kelly', 'Rowling', 'kr23@gmail.com', '12332121','45 Adam St. Bethlehem PA', '12345678'],
        ['rootuser', 'rootuser', 'rootuser@gmail.com', '12345678', '45 Adam St. Bethlehem PA', '12345678'],
        ['Richard', 'Smith', 'rs21@gmail.com', '12345678', '45 Adam St. Bethlehem PA', '12345678']
      ];
      $count = count($users);

      # Loop through each author, adding them to the database
      foreach ($users as $UserData) {
        $user = new User();

        $user->created_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
        $user->updated_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
        $user->email_verified_at = Carbon\Carbon::now()->subDays($count)->toDateTimeString();
        $user->firstname = $UserData[0];
        $user->lastname = $UserData[1];
        $user->email = $UserData[2];
        $user->password = Hash::make($UserData[3]);
        $user->address = $UserData[4];
        $user->phone = $UserData[5];
        $user->save();

        $count--;
      }
    }

}
