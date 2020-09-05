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

Route::get('/prueba', function () {
    
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


Route::get('getData',function()
{
    $id = Request()->id;
    
    $param = DB::table('categories')->where('id',$id)->first();

    $datos = DB::table('products')->where('categoria',$id)->get();
    
    $view = view("partial.products")->with('datos',$datos)->with('param',$param)->render();

    return response()->json(['html'=>$view]);

});



Route::get('getHome',function()
{
    $categorias = DB::table('categories')->orderBy('nombre')->get();
    
    $marcas = DB::table('products')->select('categoria','marca')->distinct('marca')->get();
    
    
    $view = view("partial.abc",['categorias'=>$categorias],compact('marcas'))->render();

    return response()->json(['html'=>$view]);

});

Route::get('getCart',function()
{
    
    
    $datos = DB::table('products')->where('id',Request()->id)->first();

    return response()->json([$datos]);
});




Route::get('/home', 'HomeController@index')->name('home');
