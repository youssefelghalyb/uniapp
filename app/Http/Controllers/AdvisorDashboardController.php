<?php

namespace App\Http\Controllers;

use App\Models\Advisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvisorDashboardController extends Controller
{
    public function dashboard()
    {

        $advisor = Advisor::where('user_id' , Auth::id()  ) ->first() ;  
        if(!$advisor){
            abort(403, 'Your Role is not advisor');
        }
    
        return view('advisor-dashboard.dashboard' , compact('advisor'));
    }
    //
}
