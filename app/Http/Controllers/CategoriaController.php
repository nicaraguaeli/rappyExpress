<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       
      $categorias = Category::join('groups','group_id','=','groups.id')->select('categories.nombre as nombrec','categories.imagen as imagen','groups.nombre as nombreg','categories.id','categories.estado')->get();
       
        return response()->json($categorias);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $categoria = new Category;
        $request->validate([
        'nombre'=>'required',
        'idgrupo'=>'required|numeric',
        'file' => 'dimensions:width=128,height=128|mimes:jpeg,jpg,png',
        ]);

        $file = $request->file('file')->getClientOriginalExtension();               
        $image = base64_encode(file_get_contents($request->file('file')));
        
        $categoria->nombre = $request->nombre;
        $categoria->group_id = $request->idgrupo;
        $categoria->imagen = "data:image/".$file.";base64,".$image;
        $categoria->save();

        return "Almacenado..";
   
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
        if($id == 0)
        {
            $categoryState = Category::find($request->id);

            if($categoryState->estado == '0')
            {
                $categoryState->estado = '1';
                $categoryState->save();
                return "Ahora visible...";
            }
            else
            {
                $categoryState->estado = '0';
                $categoryState->save();
                return "Ahora oculto...";
                
            }
            
            
        }
        else
        {
            $categorias = Category::find($id);
        
        try {
       
        $request->validate([

            'nombre'=>'required',
            'idgrupo'=>'required|numeric',
            
        ]);
       
        if($request->hasFile('file'))
        {
            $file = $request->file('file')->getClientOriginalExtension();
            $image = base64_encode(file_get_contents($request->file('file')));
            $categorias->imagen = "data:image/".$file.";base64,".$image;
            $categorias->nombre = $request->nombre;
            $categorias->save();
        }
        else
        {
            $categorias->nombre = $request->nombre;
            $categorias->group_id = $request->idgrupo;
            $categorias->save();

        }
        
       
       
       
       
       return "Actualizado...";
       } catch (\Illuminate\Database\QueryException $ex) {
           //throw $th;

           return "Algo salio mal";
       }

        }
       
        
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
       
        Category::find($id)->delete();
        return "Eliminado...";
    }
}
