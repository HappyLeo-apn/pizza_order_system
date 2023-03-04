<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;
use Symfony\Component\Routing\RouteCompiler;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('apiTesting', function(){
    $data = [
        'message' => 'this is api testing message'
    ];
    return response()->json($data,200);
});

Route::get('product/list', [RouteController::class, 'productList']);
Route::get('category/list', [RouteController::class, 'categoryList']);
Route::get('order/list', [RouteController::class, 'orderList']);
Route::get('contact/list', [RouteController::class, 'contactList']);
Route::get('myData/list', [RouteController::class, 'myDataList']);

//Post
Route::post('create/Category', [RouteController::class, 'createCategory']);
Route::post('create/Contact', [RouteController::class, 'createContact']);

//delete (POST)
// Route::post('delete/Category', [RouteController::class, 'deleteCategory']);

//delete (GET)
Route::get('delete/Category/{id}', [RouteController::class, 'deleteCategory']);

//category details
Route::get('category/list/{id}', [RouteController::class, 'categoryDetails']);
Route::post('category/update', [RouteController::class, 'categoryUpdate']);


