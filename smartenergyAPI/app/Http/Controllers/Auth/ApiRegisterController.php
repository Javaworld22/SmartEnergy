<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'surname' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            //'gender' => 'required|string|max:255',
           'phone' => 'required|string|max:255',
            //'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
           // 'surname' => $data['surname'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            //'gender' => $data['gender'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function apiregisteruser(Request $request)
    {
        $name = $request->input('first_name');
        $emails = $request->input('email');
        $message = $request->input('last_name');

        if ($this->postCheckUsername($request) && $this->postCheckEmail($request)) {
            return response()->json(['Username Message' => 'Username already exists', 'Email Message' => 'Email already exists / taken'], '500');
        } elseif ($this->postCheckUsername($request)) {
            return response()->json(['Username Message' => 'Username already exists'], '500');
        } elseif ($this->postCheckEmail($request)) {
            return response()->json(['Email Message' => 'Email already exists / taken'], '500');
        }

        if ($this->validator($request->all())->passes()) {
            $user = $this->create($request->all());

            $spemail = 'emmamech121@gmail.com';

            $from = $emails;
            $to = $spemail;
            $to2 = $emails;

            $subject = 'New Registration';

            $body = " <h3> My name is {$name} </h3>

                    <p> {$message}</P>

                    <p> Responnd to me through, {$emails}</p>";

            $headers = 'MIME-Version:1.0'."\r\n";

            $headers .= 'Content-Type:text/html;charset=UTF-8'."\r\n";

            $headers .= 'from: '.$from."\r\n";
            //mail($to2, $subject, $body, $headers);
            //mail($to, $subject, $body, $headers);

            return response()->json(['Message' => $user->toArray()], '200');
        } else {
            return response()->json(['Message' => 'Something went wrong in our server'], '500');
        }
    }

    /**
     * Handles the validation username.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCheckUsername(Request $request)
    {
        $username = $request->input('username');

        $count = User::where('username', $username)->count();
        if ($count == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    /**
     * Handles the validation email.
     *
     * @return \Illuminate\Http\Response
     */
    public function postCheckEmail(Request $request)
    {
        $email = $request->input('email');

        $count = User::where('email', $email)->count();

        // if (!empty($request->input('user_id'))) {
        //     $user_id = $request->input('user_id');
        //     $query->where('id', '!=', $user_id);
        // }

        // $exists = $query->exists();
        if (!$count == 0) {
            return 1;
        } else {
            return 0;
        }
    }
}
