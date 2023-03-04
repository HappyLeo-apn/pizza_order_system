<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{   
    public function showMessage(){
        $contactMessages = Contact::orderBy('created_at', 'desc')->paginate(4);
        
        return view('admin.customer_care.contactMessage', compact('contactMessages'));
    }

    public function contactPage(){
        return view('user.contact.contactPage');
    }

    public function sendMessage(Request $request){
        $this->accountValidationCheck($request);
        $contactData = $this->getContactData($request);
        Contact::create($contactData);
        return redirect()->route('user#home');
    
    }
    public function removeSMS(Request $request){
       Contact::where('id', $request->messageID)->delete();
    }

    
    private function getContactData($request){
        return [
            'name' => $request->contactUserName,
            'email' => $request->contactUserEmail,
            'message' => $request->contactMessage
        ];
    }

    

    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'contactUserName' => 'required',
            'contactUserEmail' => 'required',
            
            'contactMessage' => 'required|min:10',
            

        ])->validate();
    }
}
