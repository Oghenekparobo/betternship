<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Mayowa from Betternship
// 1:04 PM
// You are to build a simple login system for a web dashboard.
// Please write PHP scripts to do the following:

// Registration: Accepts username, email, and password. Hashes the password with password_hash() and saves users to a users.json file.


// Login: Verifies credentials (checks email and password) and starts a session if successful.


// Dashboard: Displays “Welcome, [username]” only if the user is logged in. If not, redirect to login.


// Bonus: Add a logout that ends the session and redirects back to login.


// Note: You can assume this will be tested locally (no database).
// The goal is to have a clean, functional, and secure code that could work in a real-world PHP environment.


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    if (!session()->has('username')) {
        return redirect('/login');
    }
    return view('dashboard', ['username' => session('user')]);
});

Route::get('/registration', function () {
    return view('registration');
});


Route::get('/login', function () {
    return view('login');
});


Route::post('/registration', function (Request $request) {
    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);

    $path = storage_path('users.json');
    $users = file_exists($path) ? json_decode(file_get_contents($path), true) : [];
    $hashedPassword = password_hash($request->input('password'), PASSWORD_BCRYPT);

    foreach ($users as $user) {
        if ($user['email'] === $request->input('email')) {
            return response('Email already registered.', 400);
        }
    }

    $users[] = [
        'username' => $request->input('username'),
        'email' => $request->input('email'),
        'password' => $hashedPassword,
    ];
    file_put_contents($path, json_encode($users));


    session(['user' => $request->input('username')]);
    return redirect('/login');
});


Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required',
    ]);



    $path = storage_path('users.json');
    if (!file_exists($path)) {
        return response('No users registered.', 400);
    }

    $users = json_decode(file_get_contents($path), true);



    foreach ($users as $user) {

        if ($user['email'] === $request->input('email')) {
            if (password_verify($request->input('password'), $user['password'])) {
                session(['username' => $user['username']]);
            } else {
                return response('Invalid credentials.', 400);
            }
        }
    }

    return redirect('/dashboard');
});


Route::get('/logout', function () {
    session()->forget('username');
    return redirect('/login');
});
