<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','indexController@welcome');

Route::get('/billboard',[
  'middleware' => 'auth',
  'uses' => 'indexController@list']);

Route::get('/add_slide',[
    'middleware' => 'auth',
    'uses' => 'indexController@add']);

Route::get('/update_slide/{id}',[
    'middleware' => 'auth',
    'uses' => 'indexController@update']);

Route::post('/submit_slide_form',[
        'middleware' => 'auth',
        'uses' => 'indexController@submitAdd']);

Route::put('/submit_update_slide_form/{id}',[
    'middleware' => 'auth',
    'uses' => 'indexController@submitUpdate']);

Route::delete('/delete_slide/{id}',[
      'middleware' => 'auth',
      'uses' => 'indexController@destroy']);


Route::get('/appointment/{id}',[
  'middleware' => 'auth',
  'uses' => 'AppointmentController@myAppointment']);

Route::delete('/cancel_appointment/{id}',[
  'middleware' => 'auth',
  'uses' => 'AppointmentController@cancelAppointment']);

Route::get('/make_appointment',[
  'middleware' => 'auth',
  'uses' => 'AppointmentController@mainSchedule']);

Route::post('/submit_appointment_vet',[
  'middleware' => 'auth',
  'uses' => 'AppointmentController@showSchedule']);

Route::post('/submit_appointment_slot',[
  'middleware' => 'auth',
  'uses' => 'AppointmentController@prepareAddForm']);

Route::get('/add_appointment/{id}',[
  'middleware' => 'auth',
  'uses' => 'AppointmentController@add']);

Route::post('/submit_appointment_form',[
  'middleware' => 'auth',
  'uses' => 'AppointmentController@submit']);



Route::get('/veterinarians',[
  'middleware' => 'auth',
  'uses' => 'VetController@list']);

Route::get('/add_vet',[
  'middleware' => 'auth',
  'uses' => 'VetController@add']);

Route::get('/update_vet/{id}',[
  'middleware' => 'auth',
  'uses' => 'VetController@update']);

Route::post('/submit_vet_form',[
  'middleware' => 'auth',
  'uses' => 'VetController@submit']);

Route::put('/submit_update_vet_form/{id}',[
  'middleware' => 'auth',
  'uses' => 'VetController@submitUpdate']);

Route::delete('/delete_vet/{id}',[
  'middleware' => 'auth',
  'uses' => 'VetController@destroy']);



/*
Route::get('/debug', function () {

    $debug = [
        'Environment' => App::environment(),
    ];

    $debug['MySQL connection config'] = config('database.connections.mysql');

    try {
        $databases = DB::select('SHOW DATABASES;');
        $debug['Database connection test'] = 'PASSED';
        $debug['Databases'] = array_column($databases, 'Database');
    } catch (Exception $e) {
        $debug['Database connection test'] = 'FAILED: '.$e->getMessage();
    }

    dump($debug);
});*/

Auth::routes();
