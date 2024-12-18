<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|unique:users,username|max:255',
            'password' => 'required|min:6|confirmed',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Create user
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        // Redirect after successful registration
        return redirect()->route('login')->with('success', 'Account created successfully!');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['username' => $validated['username'], 'password' => $validated['password']])) {
            session(['user' => Auth::user()]);
            return redirect()->route('home');
        } else {
            // Authentication failed
            return back()->with('error', 'Invalid credentials. Please try again.');
        }
    }

    public function destroy(Request $request)
{
    Auth::logout();

    // Regenerate session after logout
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect directly to the login page
    return redirect()->route('login'); // Use the route name for login if available
}
}
