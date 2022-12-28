<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Notifications\UserRegisterNotification;
use Illuminate\Support\Facades\Notification;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *      
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // send a notification
        auth()->user()->notify(new UserRegisterNotification(
            name:  $request->name,        
            email: $request->email,
            subject: config('global.new_user_subject'),
            message: config('global.new_user_message')       
        ));

        $name  = $request->name;
        $email = $request->email;
        $subject = config('global.user_login_subject');
        $message = config('global.user_login_message');

        Notification::route('slack', 'https://hooks.slack.com/services/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')
            ->notify(new UserRegisterNotification($name, $email, $subject, $message));

        return redirect(RouteServiceProvider::HOME);
    }
}
