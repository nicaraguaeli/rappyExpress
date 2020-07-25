<?php

use Illuminate\Support\Facades\Route;
use App\Group;
use App\Category;
use App\Product;
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


Route::get('/prueba', function () {
    
    $grupo = Group::with('categories')->get();
    
 
    return response()->json($grupo);
 

});

Route::get('/prueba/{id}', function ($id) {
    
    
    $producto = Product::where('category_id',$id)->get();
    
    
    
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