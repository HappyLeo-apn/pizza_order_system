<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home()
    {
        $pizza = Product::orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();
        
        return view('user.main.home', compact('pizza', 'category', 'cart', 'history', ));
    }

    public function filter($categoryId){
        $pizza = Product::where('category_id', $categoryId)->orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('pizza', 'category', 'cart', 'history'));
    }

    public function pizzaDetails($pizzaId){
        $pizza = Product::where('id', $pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details', compact('pizza', 'pizzaList'));
    }

    public function cartList(){
        $cartList = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price', 'products.image as pizza_image')
                          ->leftJoin('products', 'products.id', 'carts.product_id')
                          ->where('carts.user_id', Auth::user()->id)
                          ->get();
        $totalPrice = 0;
        foreach ($cartList as $c) {
            $totalPrice += $c->pizza_price * $c->qty;
        }
      
       
        return view('user.main.cart', compact('cartList', 'totalPrice'));
    }

        //History Page
    public function history(){
        $order = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('user.main.history', compact('order'));
    }

    public function changePasswordPage()
    {
        return view('user.password.change');
    }

    public function changePassword(Request $request)
    {
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password;
        if (Hash::check($request->oldPassword, $dbHashValue)) {
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

    public function accountChangePage()
    {
        return view('user.profile.account');
    }

    public function changeAccount($id, Request $request)
    {
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for image
        if ($request->hasFile('image')) {
            $dbImageName = User::where('id', $id)->first();
            $dbImageName = $dbImageName->image;

            if ($dbImageName != null) {
                Storage::delete('public/' . $dbImageName);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        User::where('id', $id)->update($data);
        return back()->with(['accountSuccess' => 'Admin account info updated...']);
    }
    public function userList(){
        $users = User::where('role','user')->orderBy('updated_at', 'desc')
            ->when(request('key'), function($query){
            $query->where('name', 'like', '%'.request('key').'%');
            })->paginate(3);
        return view('admin.users.userlist', compact('users'));
    }
    public function userChangeRole(Request $request){
        $updateSource = [
            'role' => $request->role
        ];
        User::where('id', $request->userId)->update($updateSource);
     }

    //USER MODIFICATION BY ADMIN
    //delete user

    
    public function deleteUser(Request $request){
        User::where('id', $request->userId)->delete();
    }

    //edit user
    public function modifyUserPage($id){
        $userInfo = User::where('id', $id)->first();
        
        return view('admin.users.userModification', compact('userInfo'));
    }

    //update modified user account
    public function modifyUser(Request $request, $id){
    
        $this->accountValidationCheck($request);
        $updatedUserData = $this->getUserData($request);
        //for Image
        if ($request->hasFile('image')) {
            $dbImageName = User::where('id', $id)->first();
            $dbImageName = $dbImageName->image;

            if ($dbImageName != null) {
                Storage::delete('public/' . $dbImageName);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $updatedUserData['image'] = $fileName;
        }
        User::where('id', $id)->update($updatedUserData);
        return redirect()->route('admin#userList');
        
    }


    

    //Password Validation
    private function passwordValidationCheck($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|max:10|same:newPassword',
            'image' => 'mimes:png,jpeg,jpg,webp|file'
        ])->validate();
    }
    private function getUserData($request)
    {
        return  [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' =>  $request->gender,
            'updated_at' => Carbon::now()
        ];
    }
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
