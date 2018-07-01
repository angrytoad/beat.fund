<?php

namespace App\Http\Controllers\Admin\SiteMaintenance;

use App\Http\Controllers\Controller;

class SiteMaintenanceController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }
    
    public function show(){
        return view('admin.site_maintenance.site_maintenance');
    }
}
