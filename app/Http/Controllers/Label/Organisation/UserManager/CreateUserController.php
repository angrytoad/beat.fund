<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 04/08/2018
 * Time: 17:14
 */
namespace App\Http\Controllers\Label\Organisation\UserManager;

use App\Http\Controllers\Controller;
use App\Mail\Label\Organisation\UserManager\UserInviteEmail;
use App\Models\LabelUserInvite;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Webpatser\Uuid\Uuid;

class CreateUserController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function show(){
        return view('label.organisation.user_manager.create_user');
    }

    public function create(Request $request){
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'account_type' => 'required|in:editor,manager,admin',
            'g-recaptcha-response' => 'required',
        ]);
        
        $client = new Client();
        $res = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => env('RECAPTCHA_SECRET'),
                'response' => $request->get('g-recaptcha-response')
            ]
        ]);
        $json = json_decode($res->getBody()->getContents());
        if($json->success){
            LabelUserInvite::where('email',$request->get('email'))->delete();

            $label_user_invite = new LabelUserInvite();
            $label_user_invite->label_id = Auth::user()->label->id;
            $label_user_invite->first_name = ucfirst($request->get('first_name'));
            $label_user_invite->last_name = ucfirst($request->get('last_name'));
            $label_user_invite->email = $request->get('email');
            $label_user_invite->role = $request->get('account_type');
            $label_user_invite->invite_code = Uuid::generate();
            $label_user_invite->save();
            
            Mail::to($label_user_invite->email)->send(new UserInviteEmail($label_user_invite));
            
            return redirect(route('label.organisation.user_manager'))->with([
                'alert-success' => $label_user_invite->first_name.' '.$label_user_invite->last_name.' has been successfully invited to your label.'
            ]);

        }else{
            return back()->withErrors([
                'alert-danger' => 'We could not verify that you aren\'t a robot, you haven\'t augmented yourself recently have you?'
            ]);
        }
    }
}
