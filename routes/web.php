<?php

use Illuminate\Support\Facades\Route;
use App\Group;
use App\Category;
use App\Product;
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    
    
    //$grupo = Group::all();
    
   
    
    return view('welcome');
 

});

Route::resource('/categoria', 'CategoriaController');
Route::resource('/groups', 'GroupController');
Route::resource('/producto', 'ProductoController');
Route::resource('/order', 'OrderController');

Route::get('test', function () {
    event(new App\Events\StatusLiked('Tienes una nueva orden'));
    return "Event has been sent!";
});


Route::get('/admin',function()
{
    //return view('admin.index')->with('mensaje','holaa');

    $user = User::all()->select('created_at')->first();

    return $user;
});

Route::get('/categories/list', function () {
    
    $grupo = Group::with('categories')->get();
    
 
    return response()->json($grupo);
 

});





Route::get('/items/{id}', function ($id) {
    
    
    $producto = Product::where('category_id',$id)
    ->join('categories','category_id','=','categories.id')
    ->select('products.id','products.presentacion','products.nombre','products.precio','products.imagen','products.cantidad','categories.nombre as c_nombre')
    ->get();
    
    
    
    return response()->json($producto);
 

});

Route::post('/store',function()
{
       return "Hemos recibido su pedido en breve le estaremos llamando.";
});











Route::resource('/user','UserController');

