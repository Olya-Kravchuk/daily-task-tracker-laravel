<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
// use Illuminate\Foundation\Auth\User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
// use Illuminate\Validation\ValidationException;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function login(LoginRequest $request)
    {
        // $throttleKey = strtolower($request->input('email')) . '|' . $request->ip();
        // $ipThrottleKey = 'login:' . $request->ip();
        // $emailThrottleKey = 'login:' . $request->input('email');
        // if (RateLimiter::tooManyAttempts($ipThrottleKey, 100)) {
        //     throw ValidationException::withMessages(['email' => 'Too many login attempts. Please try agaun later.']);
        // }
        // if (RateLimiter::tooManyAttempts($emailThrottleKey, 5)) {
        //     throw ValidationException::withMessages(['email' => 'Too many login attempts. Please try agaun later.']);
        // }
        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            // RateLimiter::clear($ipThrottleKey);
            // RateLimiter::clear($emailThrottleKey);

            return redirect()->intended(route('dashboard'));
        }
        // RateLimiter::hit($ipThrottleKey);
        // RateLimiter::hit($emailThrottleKey);

        // throw ValidationException::withMessages(['email' => ]);
        return back()
        ->withErrors(['email' => 'These credentials do not match our records.'])
        ->withInput($request->except('password'));
        // return back()->withErrors(['email' => 'These credentials do not match our records']);
    }
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]
        );
        event(new Registered($user));
        Auth::login($user);

        return redirect()->intended(route('dashboard'));
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
