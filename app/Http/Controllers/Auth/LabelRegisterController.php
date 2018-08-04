<?php

namespace App\Http\Controllers\Auth;

use App\Mail\Admin\AccountRegistered;
use App\Models\EmailVerification;
use App\Models\Label;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Webpatser\Uuid\Uuid;
use App\Mail\Account\Verify;
use GuzzleHttp\Client;

class LabelRegisterController extends Controller
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
    protected $redirectTo = '/account/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register_label');
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
            'id' => Uuid::generate()->string,
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'terms_and_conditions' => 'required',
            'privacy_policy' => 'required',
            
            'label_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_number' => 'required|string|max:24',
            'company_first_line' => 'required|string|max:255',
            'company_second_line' => 'nullable|string|max:255',
            'company_postcode' => 'required|string|max:24',
            'company_city' => 'required|string|max:255',
            'company_county' => 'required|string|max:255',
            'company_country' => 'required|string|max:255',
            'company_telephone' => 'nullable|string|max:255',
            'company_email' => 'required|string|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => ucfirst($data['first_name']),
            'last_name' => ucfirst($data['last_name']),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_verified' => false
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $this->validator($request->all())->validate();
        $client = new Client();
        $res = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => env('RECAPTCHA_SECRET'),
                'response' => $request->get('g-recaptcha-response')
            ]
        ]);
        $json = json_decode($res->getBody()->getContents());
        if($json->success){
            event(new Registered($user = $this->create($request->all())));

            $this->guard()->login($user);

            return $this->registered($request, $user)
                ?: redirect($this->redirectPath())->with([
                    'alert-success' => 'Thanks for registering your label, please check your email for a verification link.'
                ]);
        }else{
            return redirect(route('register-label'))->withErrors([
                'alert-danger' => 'We could not verify that you aren\'t a robot, you haven\'t augmented yourself recently have you?'
            ]);
        }
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $email_verification = new EmailVerification();
        $email_verification->user_id = $user->id;
        $email_verification->token = Uuid::generate();
        $email_verification->save();

        $label = new Label();
        $label->name = $request->get('label_name');
        $label->administrator_id = $user->id;
        $label->company_number = $request->get('company_number');
        $label->company_name = $request->get('company_name');
        $label->company_address_first_line = $request->get('company_first_line');
        $label->company_address_second_line = $request->get('company_second_line');
        $label->company_address_postcode = $request->get('company_postcode');
        $label->company_address_city = $request->get('company_city');
        $label->company_address_county = $request->get('company_county');
        $label->company_address_country = $request->get('company_country');
        $label->company_telephone_number = $request->get('company_telephone');
        $label->company_email_address = $request->get('company_email');
        $label->save();

        Mail::to($user->email)->send(new Verify($user));
        Mail::to(env('ADMIN_EMAIL','support@beat.fund'))->send(new AccountRegistered($user));
    }
}
