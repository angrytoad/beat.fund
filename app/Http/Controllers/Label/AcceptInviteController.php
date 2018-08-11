<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 11/08/2018
 * Time: 13:53
 */
namespace App\Http\Controllers\Label;

use App\Http\Controllers\Controller;
use App\Models\LabelUserInvite;
use App\Models\LabelUserRole;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class AcceptInviteController extends Controller
{
    use RegistersUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }
    
    public function show($invite_code){
        return view('label.accept_invite')->with([
            'invite_code' => $invite_code
        ]);
    }

    public function acceptInvite(Request $request, $invite_code){
        $request->validate([
            'password' => 'required|string|min:10|confirmed',
        ]);
        
        $invite = LabelUserInvite::where('invite_code',$invite_code)->first();
        if($invite !== null && Carbon::parse($invite->created_at)->addDays(7)->diffInDays(Carbon::now(), false) < 0){
            $user = User::create([
                'first_name' => $invite->first_name,
                'last_name' => $invite->last_name,
                'email' => $invite->email,
                'password' => bcrypt($request->get('password')),
                'email_verified' => true,
                'label_id' => $invite->label_id
            ]);

            $invite->delete();

            $labelUserRole = new LabelUserRole();
            $labelUserRole->label_id = $invite->label_id;
            $labelUserRole->user_id = $user->id;
            $labelUserRole->role = $invite->role;
            $labelUserRole->save();

            $this->guard()->login($user);

            return redirect(route('label.dashboard'))->with([
                'alert-success' => 'Thanks for registering, welcome to your new label account!'
            ]);
        }
        
        return back()->withErrors([
            'We were unable to verify your invite at this moment in time, if you feel that it has expired please 
            contact your label to request another.'
        ]);

    }
}
