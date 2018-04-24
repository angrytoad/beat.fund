<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminPanelController extends Controller
{
    /**
     * Renders the admin panel
     */
    public function show() {

        return view('admin.admin');

    }
}
