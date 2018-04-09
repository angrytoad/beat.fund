<?php

namespace App\Http\Controllers\Account\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
    /**
     * Renders the admin panel
     */
    public function show(Request $request) {


        return view('account.admin.admin_panel');

    }
}
