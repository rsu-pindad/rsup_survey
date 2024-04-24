<?php

namespace App\Livewire;

use App\Livewire\Forms\SurveyForm as Form;
use App\Models\KaryawanProfile;
use App\Models\Penjamin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Roots extends Component
{
    public Form $form;

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }

    public function save()
    {
        $store = $this->form->store();
        if($store == true){
            return redirect()->route('isi-survey-pelayanan');
        }
    }

    public function render()
    {
        $profile = KaryawanProfile::where('user_id', Auth::user()->id)->first();
        if ($profile) {
            return view('livewire.roots')->with([
                'petugas' => Auth::user()->name,
                'penjamin' => Penjamin::where('unit_id', $profile->unit_id)->get(),
            ]);
        }
    }
}
