<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Veterinarian;

class VetController extends Controller
{
    public function list(Request $request) {
      $vets = Veterinarian::all();

      return view('vetList')->with([
        'vets' => $vets,
        'alertText' => $request->session()->get('alertText',''),
        'successText' => $request->session()->get('successText','')
      ]);
    }

    public function add() {
      return view('vetForm');
    }

    public function update($id) {
      $vet = Veterinarian::find($id);
      if (!$vet) {
        return redirect('/veterinarians')->with([
            'alertText' => 'vet not found.',
            'successText' => ''
        ]);
      }


      return view('vetFormUpdate')->with([
          'id' => $vet->id,
          'vetName' => $vet->vetName,
          'vetAge' => $vet->vetAge,
          'vetGender' => $vet->vetGender,
          'vetExperience' => $vet->vetExperience,
          'vetDegree' => $vet->vetDegree
      ]);
    }

    public function destroy($id) {
      $vet = Veterinarian::find($id);
      if(!$vet) {
        return redirect('/veterinarians')->with([
            'alertText' => 'vet not found.',
            'successText' => ''
        ]);
      }
      $vet->delete();
      return redirect('/veterinarians')->with([
        'alertText' => '',
        'successText' => 'vet [id: '.$id.'] deleted'
      ]);
    }

    public function submit(Request $request) {
      // Validation
      $request->validate([
        'vetName' => 'required',
        'vetAge' => 'required|min:1|max:3',
        'vetDegree' => 'required|string|max:191',
        'vetGender' => 'required',
        'vetExperience' => 'required|min:1|max:2'
      ]);

      $vet = new Veterinarian();
      $vet->vetName = $request->input('vetName');
      $vet->vetAge = $request->input('vetAge');
      $vet->vetDegree = $request->input('vetDegree');
      $vet->vetGender = $request->input('vetGender');
      $vet->vetExperience = $request->input('vetExperience');
      $vet->save();

      return redirect('/veterinarians')->with([
        'alertText' => '',
        'successText' => 'Vet added successfully!'
      ]);
    }

    public function submitUpdate(Request $request, $id) {
      // Validation
      $request->validate([
        'vetName' => 'required',
        'vetAge' => 'required|min:1|max:3',
        'vetDegree' => 'required|string|max:191',
        'vetGender' => 'required',
        'vetExperience' => 'required|min:1|max:2'
      ]);

      $vet = Veterinarian::find($id);
      $vet->vetName = $request->input('vetName');
      $vet->vetAge = $request->input('vetAge');
      $vet->vetDegree = $request->input('vetDegree');
      $vet->vetGender = $request->input('vetGender');
      $vet->vetExperience = $request->input('vetExperience');
      $vet->save();

      return redirect('/veterinarians')->with([
        'alertText' => '',
        'successText' => 'Changes for vet id'.$id.' were saved.'
    ]);
    }
}
