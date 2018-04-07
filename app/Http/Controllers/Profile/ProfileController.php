<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 17/03/2018
 * Time: 02:30
 */
namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\ProfileLink;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function show()
    {
        return view('profile.profile')->with([
            'profile' => Auth::user()->profile
        ]);
    }
    
    public function update(Request $request)
    {
        $profile = Auth::user()->profile;
        $user = Auth::user();

        /**
         * We need to make srue that the website and email are the right format if not null.
         */
        $request->validate([
            'artist_name' => 'required',
            'artist_website' => 'nullable|url',
            'business_email' => 'nullable|email'
        ]);

        /**
         * If the user has a store and it is live, we need to make sure they can't empty critical information we require 
         * for the store.
         */
        if($user->store && $user->store->live){
            $rules = [
                'artist_name' => 'required',
                'artist_bio' => 'required',
                'favourite_genre' => 'required',
                'artist_website' => 'required',
                'business_email' => 'required'
            ];

            $messages = [
                'artist_name.required' => 'You cannot clear the Artist Name field whilst you\'re store is live, please turn disable it first.',
                'artist_bio.required' => 'You cannot clear the Artist Bio field whilst you\'re store is live, please turn disable it first.',
                'favourite_genre.required' => 'You cannot clear the Favourite Genre field whilst you\'re store is live, please turn disable it first.',
                'artist_website.required' => 'You cannot clear the Artist Website field whilst you\'re store is live, please turn disable it first.',
                'business_email.required' => 'You cannot clear the Business Email field whilst you\'re store is live, please turn disable it first.',
            ];

            $request->validate($rules, $messages);
        }
        
        


        if(Auth::user()->store){
            $count = Store::where('slug',str_slug($request->get('artist_name'),'-'))->count();
            if($count > 0){
                $slug = str_slug($request->get('artist_name').'-'.$count,'-');
            }else{
                $slug = str_slug($request->get('artist_name'),'-');
            }

            $store = Auth::user()->store;
            $store->slug = $slug;
            $store->save();
        }

        $profile->artist_name = $request->get('artist_name');
        $profile->artist_bio = $request->get('artist_bio');
        $profile->favourite_genre = $request->get('favourite_genre');
        $profile->artist_website = $request->get('artist_website');
        $profile->business_email = $request->get('business_email');

        $error_bag = [];
        
        if($request->has('social_link')){
            foreach($request->get('social_link') as $social_link){
                $validate = Validator::make($social_link, [
                    'type' => 'required|max:255',
                    'link' => 'required|url',
                ]);

                if($validate->fails()) {
                    $error_bag[] = 'Your ' . $social_link['type'] . ' link must have a valid url';
                }
            }
        }

        if(count($error_bag) > 0){
            $request->flash();
            return back()->withErrors($error_bag);
        }else{
            $profile->profile_links()->delete();

            if($request->has('social_link')){
                foreach($request->get('social_link') as $social_link){
                    $profile_link = new ProfileLink();
                    $profile_link->profile_id = $profile->id;
                    $profile_link->type = $social_link['type'];
                    $profile_link->link = $social_link['link'];
                    $profile_link->save();
                }
            }

        }

        $profile->save();

        return back()->with([
            'alert-success' => 'Profile successfully updated.'
        ]);

    }
}
