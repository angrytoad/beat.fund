<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 01/07/2018
 * Time: 21:39
 */

namespace App\Http\Controllers\Admin\SiteMaintenance;


use App\Http\Controllers\Controller;
use App\Mail\Misc\USER_FeatureSuggestionAdded;
use App\Models\FeatureSuggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeatureSuggestionsController extends Controller
{

    public function __construct()
    {
    }
    
    public function show(){
        return view('admin.site_maintenance.feature_suggestions')->with([
            'suggestions' => FeatureSuggestion::all()
        ]);
    }
    
    public function createSuggestion(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'featured_link' => 'max:255',
            'suggestion' => 'required|string|max:1000',
        ]);
        
        $featureSuggestion = new FeatureSuggestion();
        $featureSuggestion->name = $request->get('name');
        $featureSuggestion->email = $request->get('email');
        $featureSuggestion->featured_link = $request->get('featured_link');
        $featureSuggestion->suggestion = $request->get('suggestion');
        $featureSuggestion->save();
        
        Mail::to($request->get('email'))->send(new USER_FeatureSuggestionAdded($request));

        return back()->with([
            'alert-success' => 'New Feature Suggestion created!'
        ]);
    }

}