<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class UserAccount extends Component
{
    public $isLoggedIn = false;
    public $user = null;

    public function mount()
    {
        $this->checkAuthStatus();
    }

    #[On('customer-logged-in')]
    #[On('customer-registered')]
    public function checkAuthStatus()
    {
        $this->isLoggedIn = Auth::guard('customer')->check();
        $this->user = Auth::guard('customer')->user();
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        session()->invalidate();
        session()->regenerateToken();

        $this->isLoggedIn = false;
        $this->user = null;

        session()->flash('success', 'Đăng xuất thành công!');
    }



    public function render()
    {
        return view('livewire.public.user-account');
    }
}
