<?php

namespace App\Http\Controllers\Auth;

use App\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/clients';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return Inertia::render('Home');
    }

    protected function authenticated(Request $request, $user)
    {
        return Inertia::render('Clients/Index', [
            'clients' => auth()->user()->clients()->latest()->get()
        ]);
    }

    protected function loggedOut(\Illuminate\Http\Request $request)
    {
        // $posts = (auth()->user() && auth()->user()->can('create', Post::class)) ? Post::latest()->get() : Post::published();

        // return Inertia::render('Posts/Index', [
        //     'posts' => $posts
        // ]);

        return redirect('/blog');
    }
}
