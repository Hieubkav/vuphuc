<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use Illuminate\Validation\ValidationException;

class CustomerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('customer.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        
        $credentials = [
            $loginField => $request->login,
            'password' => $request->password,
        ];

        if (Auth::guard('customer')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        throw ValidationException::withMessages([
            'login' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }

    public function showRegisterForm()
    {
        return view('customer.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email',
            'phone' => 'nullable|regex:/^[0-9]{10,11}$/|unique:customers,phone',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Kiểm tra ít nhất email hoặc phone phải có
        if (empty($request->email) && empty($request->phone)) {
            throw ValidationException::withMessages([
                'email' => 'Vui lòng nhập ít nhất email hoặc số điện thoại',
                'phone' => 'Vui lòng nhập ít nhất email hoặc số điện thoại',
            ]);
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email ?: null,
            'phone' => $request->phone ?: null,
            'password' => Hash::make($request->password),
            'status' => 'active',
        ]);

        Auth::guard('customer')->login($customer);

        return redirect()->intended('/');
    }

    public function showProfile()
    {
        return view('customer.profile');
    }
}
