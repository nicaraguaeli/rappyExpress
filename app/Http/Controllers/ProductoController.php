<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return "index";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return "create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
            //code...
            Request()->validate([
           
                'file' => 'dimensions:width=400,height=400|mimes:jpeg,jpg,png',
                'nombre' =>'required',
                'presentacion'=>'required',
                'precio'=>'required|numeric',
                'categoria'=>'required|numeric'
        
                ]);
    
            
           $imageName = time().'.'.request()->file->getClientOriginalExtension();
    
            
    
            request()->file->move(public_path('img/img-product'), $imageName);
            
            $product = new Product;
            $product->nombre = $request->nombre;
            $product->precio = $request->precio;
            $product->presentacion = $request->presentacion;
            $product->category_id = $request->categoria;
            $product->imagen = "img/img-product/".$imageName;
            $product->save();
    
                
            return "store";
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return "edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        return "update";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return "destroy";
    }
}
