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
       
        $categorias = Category::join('groups','group_id','=','groups.id')->select('categories.nombre as nombrec','imagen','groups.nombre as nombreg','categories.id')->get();
        
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

        return "desde el estore";
   
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
        //
       // $dato = Category::find($id)->update($request->all());
        
       # return response
      
       $categoria = Category::find($id);
     
       if($request->hasFile('file'))
       {
            Request()->validate([
                'file' => 'dimensions:width=128,height=128|mimes:jpeg,jpg,png',
                'nombre' =>'required',
        
                ]);
       

            $file = $request->file('file')->getClientOriginalExtension();
                
            $image = base64_encode(file_get_contents($request->file('file')));
           
            try {
                
            
            $categoria->nombre = $request->nombre;
            $categoria->group_id = $request->group_id;
            $categoria->imagen = "data:image/".$file.";base64,".$image;
            

            return $categoria;

            } catch (\Illuminate\Database\QueryException $ex) {
                //throw $th;
                return $ex->getMessage();
            }
            


                

       }
       else
       {
           
           $categoria->nombre = $request->nombre;
           $categoria->group_id = $request->group_id;
           $categoria->save();
           return "Ha sido actualizado";
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
       
        return "ELIMiNADO".$id;
    }
}
