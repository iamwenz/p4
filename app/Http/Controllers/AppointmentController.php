<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Veterinarian;
use App\Appointment;
use App\User;
use Carbon\Carbon;



class AppointmentController extends Controller {
  public function mainSchedule(Request $request) {
    $vets = Veterinarian::all();
    $alertText;
    $successText;
    $scheduledVet;
    $selectedVetId = ($request->session()->get('selectedVetId', ''));
    $selectedVet = '';

    $availableWeekSlot = [];
    $availableDaySlot = [];
    $availableTime = '';
    $today = Carbon::now();
    $timeTemp = 8;
    $found = false;

    # Fetch appointment associate with the vet using many to many relation
    if($selectedVetId === '') {
      $alertText = 'Please Select a Vet to view the available schedule.';
      $successText = '';
      $scheduledVet = '';

    } else {
      $alertText = '';
      $selectedVet = Veterinarian::find($selectedVetId);
      $successText = 'Schedule of '.$selectedVet->vetName.' is displayed. Please click on the following available time. NOTE: You can only make appointment for the next seven days.';

      if($selectedVet) {
        $scheduledVet = Veterinarian::with('appointments')->find($selectedVetId);


        # figure out the available schedule for the next 7 days
        for($j = 0; $j < 6; $j++) {
          $dayOfToday = $today->day;
          $monthOfToday = $today->month;
          $yearOfToday = $today->year;
          $daysInMonth = $today->daysInMonth;
          $availableDaySlot = [];
          for($i =0; $i < 7; $i++) {
            if($timeTemp < 10){
              $availableTime = $yearOfToday.'/'.$monthOfToday.'/'.$dayOfToday.' 0'.$timeTemp.':00:00';
            } else{
              $availableTime = $yearOfToday.'/'.$monthOfToday.'/'.$dayOfToday.' '.$timeTemp.':00:00';
            }

            foreach($scheduledVet->appointments as $appt){
              if($appt->appointment_time == $availableTime) {
                $found = true;
                break 1;
              }
            }
            if($found == true){
              array_push($availableDaySlot,'');
              $found = false;
            } else {
              array_push($availableDaySlot,$availableTime);
            }

            $dayOfToday += 1;

            if($dayOfToday >= $daysInMonth){
              if($monthOfToday == 12){
                  $monthOfToday = 1;
                  $yearOfToday += 1;
                  $dayOfToday = 1;
              } else {
                $monthOfToday += 1;
                $dayOfToday = 1;
              }
            }
          }
          $timeTemp = (int)$timeTemp + 2;

          array_push($availableWeekSlot,$availableDaySlot);
        }
      }
    }

    return view('appointment')->with([
      'vets'=> $vets,
      'alertText' => $alertText,
      'successText' => $successText,
      'selectedVet' => $selectedVet,
      'scheduledVet' => $scheduledVet,
      'availableSlot'=>$availableWeekSlot
    ]);
  }

  public function showSchedule(Request $request) {
    $selectedVetId = $request->input('vet_id');
    if($selectedVetId == ''){
      return redirect('/make_appointment')->with([
        'alertText' => '',
        'successText' => '',
        'selectedVetId' => '',
      ]);
    }
    return redirect('/make_appointment')->with([
      'alertText' => '',
      'successText' => '',
      'selectedVetId' => $request->input('vet_id'),
    ]);
  }

  public function add (Request $request, $id){
    $vet = Veterinarian::find($id);

    return view('appointmentForm')->with([
      'alertText' => '',
      'successText' => 'Please continue filling out the form.',
      'vet_id' => $vet->id,
      'vet_name'=> $vet->vetName,
      'appointment_time' => $request->session()->get('appointment_time')
    ]);
  }

  public function prepareAddForm(Request $request){
      return redirect('/add_appointment/'.$request->input('vet_id'))->with([
        'alertText' => '',
        'successText' => '',
        //'vet_id' => $request->input('vet_id'),
        'appointment_time' => $request->input('appointment_time')
      ]);
  }

  public function submit(Request $request) {
    // Validation
    $request->validate([
      'appointment_time' => 'required',
      'pet_name' => 'required|string|max:191',
      'gender' => 'required|string|max:191',
      'species' => 'required|string|max:191',
      'breed' => 'required|string|max:191',
      'birth_year' => 'required|min:4|max:4',
      'vet_id' => 'required',
      'symptom' => 'required|string|max:191'
    ]);

    $appointment = new Appointment();
    $appointment->appointment_time = $request->input('appointment_time');
    $appointment->pet_name = $request->input('pet_name');
    $appointment->gender = $request->input('gender');
    $appointment->species = $request->input('species');
    $appointment->breed = $request->input('breed');
    $appointment->birth_year = $request->input('birth_year');
    $appointment->symptom = $request->input('symptom');
    $user = User::find($request->user()->id);
    $appointment->user()->associate($user);
    $appointment->save();

    $vet = Veterinarian::find($request->input('vet_id'));
    $appointment->veterinarians()->sync($vet);


    return redirect('/appointment/'.$request->user()->id)->with([
      'alertText' => '',
      'successText' => 'Appointment booked successfully!'
    ]);

  }

  public function myAppointment(Request $request, $id){
    $appointments = Appointment::where('user_id','=',$id)->with('user')->get();
    $user = $request->user();

    return view('myAppointment') -> with([
      'appointments'=>$appointments,
      'user'=>$user,
      'alertText' => '',
      'successText' => ''
    ]);
  }

  public function cancelAppointment(Request $request, $id){
    $appointment = Appointment::find($id);

    if(!$appointment) {
      return redirect('/appointment/'.$request->user()->id)->with([
        'alertText' => 'cancel appointment failed due to appointment not found',
        'successText' => ''
      ]);
    }

    if($appointment->user->id != $request->user()->id) {
      return redirect('/appointment/'.$request->user()->id)->with([
        'alertText' => 'cancel appointment failed due to permission denied.',
        'successText' => ''
      ]);
    }

    $appointment->veterinarians()->detach();
    $appointment->delete();

    return redirect('/appointment/'.$request->user()->id)->with([
      'alertText' => '',
      'successText' => 'appointment is successfully canceled.'
    ]);
  }



}
