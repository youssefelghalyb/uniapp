<?php 



namespace App\Http\Controllers;

use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController{
    public function index(){
        return view('dashboard.index');
    }




    public function contact(){
        return view('dashboard.contact');
    }


    public function contactPost(Request $request){
        try{
            $request->validate([
                'message' => 'required|string'
            ]);

            Contact::create([
                'message' => $request->message,
                'user_id' => Auth::id()
            ]);

            return redirect()->back()->with('success' , 'Message Sent Successfully');
        }catch(Exception $e){
            return redirect()->back()->with('error' , 'Something went wrong ' . $e->getMessage());
        }
    }


    public function contactsList(){
        $messages = Contact::all();
        return view('dashboard.contacts-list' , compact('messages'));
    }
}
