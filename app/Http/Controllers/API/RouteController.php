<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{   
    //get product list
    public function productList(){
        $products = Product::get();
        
        
        return response()->json($products, 200);
        
    }

    //Get category list
    public function categoryList(){
        $categories = Category::get();
        return response()->json($categories, 200);
    }

    public function orderList(){
        $orders = Order::get();
        return response()->json($orders, 200);
    }

    public function contactList(){
        $contacts = Contact::get();
        return response()->json($contacts, 200);
    }

    public function myDataList(){
        $products = Product::get();
        $categories = Category::get();
        $orders = Order::get();
        $contacts = Contact::get();
        $data = [
            'products' => $products,
            'categories' => $categories,
            'orders' => $orders,
            'contacts' => $contacts
        ];
        return response()->json($data , 200);
    }

    public function createCategory(Request $request){
      $data = [
        'name' => $request->name,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ];
      $response = Category::create($data);
      return response()->json($response, 200);
    }

    public function createContact(Request $request){
       $data = $this->getContactData($request);
      Contact::create($data);
      $contacts = Contact::orderBy('created_at', 'desc')->get();

        return response()->json($contacts, 200);
    }

    
    // public function deleteCategory(Request $request){
    //     $deleteData = Category::where('id', $request->category_id)->first();
    //     if(isset($deleteData)){
    //         Category::where('id', $request->category_id)->delete();
    //         return response()->json(['status' => true, 'message' => "Delete Success"], 200);
    //     }
    //     return response()->json(['status' => false, 'message' => "No Category"], 500);
    // }

    public function deleteCategory($id){
        $deleteData = Category::where('id',$id)->first();
        if(isset($deleteData)){
            Category::where('id',$id)->delete();
            return response()->json(['status' => true, 'message' => "Delete Success", 'deletedData' => $deleteData], 200);
        }
        return response()->json(['status' => false, 'message' => "No Category"], 500);
    }

    public function categoryDetails($id){
        $data = Category::where('id',$id)->first();
        if(isset($data)){
           
            return response()->json(['status' => true, 'category' => $data], 200);
        }
        return response()->json(['status' => false, 'category' => "No Category"], 500);
    }

    public function categoryUpdate(Request $request){
      
        $category_id = $request->Category_id;
        $db_source = Category::where('id', $category_id)->first();
        if(isset($db_source)){
            $data = $this->getCategoryData($request);   
           $response = Category::where('id', $category_id)->update($data);
            return response()->json(['status' => true, 'message' =>  'Update Success!', 'category' => $response], 200);
        }
        return response()->json(['status' => false, 'category' => "No Category"], 500);
        

    }

    private function getContactData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
    }
    private function getCategoryData($request){
        return [
            'name' => $request->Category_name,

        ];
    }
}

