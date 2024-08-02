<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use App\Models\SecurityWanted;
use Exception;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // $initial_incident_count = Incident::query();
        // $supplementary_incident_count = Incident::query();
        // $transferred_incident_count = Incident::query();
        // $checked_incident_count = Incident::query();
        // $fake_incident_count = Incident::query();
        // if (auth()->user()->user_type == 'user') {
        //     $initial_incident_count->where('department_id', auth()->user()->department_id);
        //     $supplementary_incident_count->where('department_id', auth()->user()->department_id);
        //     $transferred_incident_count->where('department_id', auth()->user()->department_id);
        //     $checked_incident_count->where('department_id', auth()->user()->department_id);
        //     $fake_incident_count->where('department_id', auth()->user()->department_id);
        // }
        $data = [
            'incident_count' =>  0,
            'initial_incident_count' =>  0,
            'supplementary_incident_count' =>  0,
            'transferred_incident_count' =>  0,
            'checked_incident_count' =>  0,
            'fake_incident_count' =>  0,
            'security_wanted_count' =>  0,
            'deleted_security_wanted_count' =>  0,
        ];
        return view('admin.page.dashboard')->with('data', $data);
    }

}
