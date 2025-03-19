<?php

namespace App\Http\Controllers;

use App\Models\Advisor;
use App\Models\Request as MyCustomRequest;
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




    public function myRequests(){
        $advisor = Advisor::where('user_id' , Auth::id())->first();

        $requests = MyCustomRequest::where('advisor_id' , $advisor->id)->get();
        return view('advisor-dashboard.requests.index' , compact('requests' , 'advisor'));
        
    }



    
}
