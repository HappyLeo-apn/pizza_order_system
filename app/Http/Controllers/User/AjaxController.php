<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
   //return pizza List
   public function pizzaList(Request $request){
     logger($request->all());
   if($request->status == "desc"){
      $pizza = Product::orderBy('created_at', 'desc')->get();
   }
   else{
      $pizza = Product::orderBy('created_at', 'asc')->get();
   }
   
    return response()->json($pizza, 200);
   }

   //add to cart function
   public function addToCart(Request $request){
      $data = $this->getOrderData($request);
      Cart::create($data);
      $response = [
         'message' => "Add to cart completed",
         'status' => 'success'
      ];
      return response()->json($response, 200);
   }
   public function order(Request $request){
      $total = 0;
      foreach($request->all() as $item){
         $data = OrderList::create($item);
         $total += $data->total;
      }
      Cart::where('user_id', Auth::user()->id)->delete();
      
      Order::create([
         'user_id' => Auth::user()->id,
         'order_code' => $data->order_code,
         'total_price' => $total + 3000
      ]);
      return response()->json( [ 'status' => 'true','message' => 'order complete'], 200);
     
   }
   public function clearCart(){
      Cart::where('user_id', Auth::user()->id)->delete();
   }

   public function clearCurrentProduct(Request $request){
      Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $request->productId)
            ->where('id', $request->orderId)
            ->delete();
   }

   public function increaseViewCount(Request $request){
      logger($request->all());
      $pizza = Product::where('id', $request->productId)->first();
      $view_count = [
         'view_count' => $pizza->view_count + 1,
      ];
      Product::where('id', $request->productId)->update($view_count);
   }

   //get order data for cart
   private function getOrderData($request){
      return [
         'user_id' => $request->userId,
         'product_id' => $request->pizzaId,
         'qty' => $request->count,
         'created_at' => Carbon::now(),
         'updated_at' => Carbon::now(),
      ];
   }
}
