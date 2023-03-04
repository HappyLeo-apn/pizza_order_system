<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    //Password Change
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
       
        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue =$user->password;
        if(Hash::check($request->oldPassword, $dbHashValue)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
           User::where('id', Auth::user()->id)->update($data);
        //    Auth::logout();
        //    return redirect()->route('auth#loginPage');
            return back()->with(['changeSuccess' => "Password successfully changed!"]);

           
        }
        return back()->with(['notMatch' => "Old password does not match! Try Again!"]);
       

    }
    //Admin Acoount details
    public function details(){
        return view('admin.account.details');
    }

    public function edit(){
        return view('admin.account.edit');
    }
    //Update Account 
    public function update($id, Request $request){
       $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for image
        if($request->hasFile('image')){
            $dbImageName = User::where('id', $id)->first();
            $dbImageName = $dbImageName->image;

            if($dbImageName != null){
                Storage::delete('public/' . $dbImageName);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
           $request->file('image')->storeAs('public', $fileName);
           $data['image'] = $fileName;
        }
        User::where('id', $id)->update($data);
        return redirect()->route('admin#details')->with(['accountSuccess' => 'Admin account info updated...']);

    }

    //Admin List
    public function list(){
        $admin = User::when(request('key'), function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                ->orWhere('email','like','%'.request('key').'%')
                ->orWhere('gender','like','%'.request('key').'%')
                ->orWhere('phone','like','%'.request('key').'%')
                ->orWhere('address','like','%'.request('key').'%');
        })->where('role', 'admin')->paginate(3);
        
        
        $admin->appends(request()->all());
        
        return view('admin.account.list',compact('admin'));
    }

    //Change Admin to User
    public function changeAdmintoUser(Request $request){
        $role = [
            'role' => $request->role
        ];
        User::where('id', $request->userId)->update($role);
        
    }

    public function delete($id){
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Admn account was deleted successfully']);
    }

    public function changeRole($id){
        $account = User::where('id', $id)->first();
        return view('admin.account.changeRole', compact('account'));
    }
    public function change($id, Request $request){
        $data = $this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    //Password Validation
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword',
            'image' => 'mimes:png,jpeg,jpg|file'
        ])->validate();
    }
    //Get uesr data
    private function getUserData($request){
        return  [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' =>  $request->gender,
            'updated_at' => Carbon::now()
        ];
    }

    //Request User Data 
    private function requestUserData($request){
        return [
            'role'=>$request->role
        ];
    }

    //Account Validation 
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',

        ])->validate();
    }
}
