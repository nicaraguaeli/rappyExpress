<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Group;
class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            //code...
        $groups = Group::all();

        return response()->json($groups);

        } catch (\Throwable $th) {
            //throw $th;

            return $th;
        }
        
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
        
        $group = new Group;

        try {
            //code...
           
            
            $request->validate([

                'nombre'=>'required',
                'file' => 'dimensions:width=128,height=128|mimes:jpeg,jpg,png',
            ]);
            
            $file = $request->file('file')->getClientOriginalExtension();
                
            $image = base64_encode(file_get_contents($request->file('file')));
            
            $group->nombre = $request->nombre;
            $group->imagen = "data:image/".$file.";base64,".$image;
            $group->save();

            return "Almacenado... ";



        } catch (\Illum $th) {
            //throw $th;
            
            return "Algo salio mal";
        }
        


       
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
        if($id == 0)
        {
            $groupState = Group::find($request->id);

            if($groupState->estado == '0')
            {
                $groupState->estado = '1';
                $groupState->save();
                return "Ahora visible...";
            }
            else
            {
                $groupState->estado = '0';
                $groupState->save();
                return "Ahora oculto...";
                
            }
            
            
        }
        else
        {
            $group = Group::find($id);
        
        try {
       
        $request->validate([

            'nombre'=>'required',
            
        ]);
       
        if($request->hasFile('file'))
        {
            $file = $request->file('file')->getClientOriginalExtension();
            $image = base64_encode(file_get_contents($request->file('file')));
            $group->imagen = "data:image/".$file.";base64,".$image;
            $group->nombre = $request->nombre;
            $group->save();
        }
        else
        {
            $group->nombre = $request->nombre;
            $group->save();

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
        Group::find($id)->delete();
        return "Grupo Eliminado";
    }
}
