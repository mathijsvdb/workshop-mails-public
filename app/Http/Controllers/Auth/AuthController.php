<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use MandrillMail;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /*
     * Change redirectpath
     */
    protected $redirectPath = '/';

    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());
        $template_content = [];
        $message = array(
            'subject' => 'Welkom bij de workshop',
            'from_email' => 'noreply@workshop.com',
            'from_name' => 'Workshop',
            'to' => array(
                array(
                    'email' => $request->input('email'),
                    'name' => $request->input('name'),
                    'type' => 'to'
                )
            ),
            'merge_vars' => array(
                array(
                    'name' => 'NAME',
                    'content' => $request->input('name')
                ),
                array(
                    'name' => 'EMAIL',
                    'content' => $request->input('email')
                )
            )
        );

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        Auth::login($this->create($request->all()));

        MandrillMail::messages()->sendTemplate('registration-mail', $template_content, $message);

        return redirect($this->redirectPath());
    }

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
