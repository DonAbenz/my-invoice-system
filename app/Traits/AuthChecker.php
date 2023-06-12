<?php

namespace App\Traits;

use Illuminate\Support\Facades\Hash;

trait AuthChecker
{
    protected function checkAuth($password)
    {
        if (!Hash::check($password, auth()->user()->password)) {
            $this->dispatchBrowserEvent('swal', [
                'icon' => 'error',
                'title' => 'Oops!',
                'text' => 'Password is Incorrect!.. Please try again.',
            ]);
            $this->resetValidation();
            return true;
        }

        return false;
    }
}
