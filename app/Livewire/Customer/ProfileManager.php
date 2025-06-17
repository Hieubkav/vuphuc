<?php

namespace App\Livewire\Customer;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileManager extends Component
{
    public $name = '';
    public $address = '';
    public $current_password = '';
    public $new_password = '';
    public $new_password_confirmation = '';
    public $activeTab = 'info'; // 'info' hoặc 'password'

    public function mount()
    {
        $customer = Auth::guard('customer')->user();
        if ($customer) {
            $this->name = $customer->name;
            $this->address = $customer->address ?? '';
        }
    }

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
        ];

        if ($this->activeTab === 'password') {
            $rules['current_password'] = 'required';
            $rules['new_password'] = 'required|min:6|confirmed';
        }

        return $rules;
    }

    protected $messages = [
        'name.required' => 'Vui lòng nhập họ và tên',
        'name.max' => 'Họ và tên không được quá 255 ký tự',
        'address.max' => 'Địa chỉ không được quá 500 ký tự',
        'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại',
        'new_password.required' => 'Vui lòng nhập mật khẩu mới',
        'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự',
        'new_password.confirmed' => 'Xác nhận mật khẩu không khớp',
    ];

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetValidation();
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
    }

    public function updateInfo()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
        ]);

        $customer = Auth::guard('customer')->user();
        $customer->update([
            'name' => $this->name,
            'address' => $this->address,
        ]);

        session()->flash('success', 'Cập nhật thông tin thành công!');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $customer = Auth::guard('customer')->user();

        if (!Hash::check($this->current_password, $customer->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Mật khẩu hiện tại không chính xác.',
            ]);
        }

        $customer->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        session()->flash('success', 'Đổi mật khẩu thành công!');
    }

    public function render()
    {
        return view('livewire.customer.profile-manager');
    }
}
