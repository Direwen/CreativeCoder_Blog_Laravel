<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        //if this validation passes, will return the array which contains validated data 
        //if not, will return to form page
        $formData = request()->validate([
            // required: The 'email' field must be present in the form data.
            // email: The 'email' field must be a valid email address.
            // max:255: The 'email' field must not exceed 255 characters.
            // min:3: The 'email' field must be at least 3 characters.
            // Rule::unique('users', 'email'): Ensures that the 'email' is unique in the 'users' table. 
            'name' => 'required|max:255|min:3',//same as ['required', 'email']
            'username' => 'required|max:255|min:3|'. Rule::unique('users', 'username'),
            'email' => 'required|email|max:255|min:3|'. Rule::unique('users', 'email'),
            'password' => 'required|min:8|max:255'
        ]);

        //if validation is successful 
        $user = User::create($formData);
        //Authentication
        //to login the user
        auth()->login($user);
        // Flash Msgs r stored only for the next request and then automatically cleared, ensuring one-time display
        // session()->flash('success', 'Welcome Dear, ' . $user->name);
        // same as ->with();
        return redirect('/')->with('success', 'Welcome Dear, ' . $user->name);

    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Adios`');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function post_login()
    {
        //validation
        $formData = request()->validate([
            'email'=> ['required', 'max:255', Rule::exists('users', 'email')],
            'password'=> ['required', 'min:3', 'max:255']
            // passwords are usually hashed, and checking them here directly won't work as expected
        ],[
            //overrriding default error messages
            'email.required' => 'We need your email address',
            'password.min' => 'Password must be at least 3 characters'
        ]);
        //auth attempt
        // Laravel's attempt method is to log in a user based on the provided credentials for authentication
        // will internally handle the password verification
        if(auth()->attempt($formData))
        {
            //if creds correct, redirect
            if(auth()->user()->is_admin)
            {
                return redirect('/admin/blogs');
            }else{
                return redirect('/')->with('success', 'Welcome back');
            }
        }else{
            //if wrong, redirect back to login page with error
            return redirect()->back()->withErrors([
                'email' => 'Wrong Credentials'
            ]);
        }
    }
}
