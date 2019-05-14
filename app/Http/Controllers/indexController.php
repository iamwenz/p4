<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class indexController extends Controller
{
  public function welcome(Request $request) {
    $slides = Slide::where('active',1)->get();

    if($request->user() != null){
      return view('welcome')->with([
        'user'=>$request->user(),
        'slides'=>$slides
      ]);
    } else {
      return view('welcome')->with([
        'user'=>null,
        'slides'=>$slides
      ]);
    }
  }

  public function list(Request $request) {
    $slides = Slide::all();

    return view('slideList')->with([
      'slides'=>$slides,
      'alertText'=>$request->session()->get('alertText'),
      'successText'=>$request->session()->get('successText')
    ]);
  }

  public function add() {
    return view('slideForm')->with([
      'alertText'=>'',
      'successText'=>''
    ]);
  }

  public function submitAdd(Request $request) {
    // Validation
    $request->validate([
      'title' => 'required|string|max:191',
      'content' => 'required|string|max:191',
      'background_url' => 'required|string|max:191'
    ]);

    $slide = new Slide();
    $slide->title = $request->input('title');
    if($request->input('sub_title') !== null){
      $slide->sub_title = $request->input('sub_title');
    } else {
      $slide->sub_title = ' ';
    }
    $slide->content = $request->input('content');
    $slide->background_url = $request->input('background_url');

    if($request->input('active') === 'on'){
      $slide->active = true;
    } else{
      $slide->active = false;
    }
    $slide->save();

    return redirect('/billboard')->with([
      'alertText'=>'',
      'successText'=>'Slide:'.$request->input('title').' added successfully.'
    ]);
  }

  public function update($id) {
    $slide = Slide::find($id);

    return view('slideFormUpdate')->with([
      'slide'=>$slide,
      'alertText'=>'',
      'successText'=>''
    ]);
  }

  public function submitUpdate(Request $request, $id) {
    // Validation
    $request->validate([
      'title' => 'required|string|max:191',
      'content' => 'required|string|max:191',
      'background_url' => 'required|string|max:191'
    ]);

    $slide = Slide::find($id);

    $slide->title = $request->input('title');
    if($request->input('sub_title') !== null){
      $slide->sub_title = $request->input('sub_title');
    } else {
      $slide->sub_title = ' ';
    }
    $slide->content = $request->input('content');
    $slide->background_url = $request->input('background_url');

    if($request->input('active') === 'on'){
      $slide->active = true;
    } else{
      $slide->active = false;
    }
    $slide->save();

    return redirect('/billboard')->with([
      'alertText'=>'',
      'successText'=>'Slide:'.$request->input('title').' updated successfully.'
    ]);
  }


  public function destroy($id) {
        $slide = Slide::find($id);
        if(!$slide) {
          return redirect('/billboard')->with([
              'alertText' => 'slide not found.',
              'successText' => ''
          ]);
        }
        $title = $slide->title;
        $slide->delete();

        return redirect('/billboard')->with([
          'alertText' => '',
          'successText' => 'slide [id: '.$id.'. title:'.$title.'] deleted'
        ]);
  }


}
