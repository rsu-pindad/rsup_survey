<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Carbon\Carbon;
class UserProfileChangePasswordForm extends Form
{

    #[Locked]
    public $userId;

    #[Validate('required')]
    public $oldPassword;

    #[Validate('required|required_with:oldPassword|min:6')]
    public $newPassword;

    #[Validate('required|required_with:newPassword|same:newPassword|min:6')]
    public $reTypePassword;

    public function setUser($id)
    {
        $user = User::find($id);
        $this->user = $user;
        $this->userId = $user->id;
    }

    public function update()
    {
        // dd(Hash::check($this->oldPassword,Auth::user()->password));
        // dd($this->userId);
        $this->validate();
        try {
            Carbon::setLocale('id');
            $time = Carbon::now()->setTimezone('Asia/Jakarta');
            $check = Hash::check($this->oldPassword, Auth::user()->password);
            if ($check == true) {
                $user = User::find($this->userId);
                $user->password = bcrypt($this->newPassword);
                $user->updated_at = $time;
                $user->save();
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
