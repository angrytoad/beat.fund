<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 28/07/2018
 * Time: 17:40
 */
namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;

class RegistrationPreambleController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    public function showForArtists()
    {
        return view('misc.registration_preamble.beatfund_for_artists');
    }

    public function showForLabels()
    {
        return view('misc.registration_preamble.beatfund_for_labels');
    }
}
