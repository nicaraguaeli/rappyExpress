<?php

namespace App\Http\Controllers;
use App\Events\StatusLiked;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Order;
use App\Customer;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::where('enviado',0)->get();

        return response()->json($orders);
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
       
           # code...
           Request()->validate([
           
            'nombre'=>'required',
            'telefono'=>'required|numeric',
            'direccion'=>'required'

           ]);
           
           try {
            DB::beginTransaction();
            // database queries here
            
            $customer = new Customer;
            $customer->nombre = $request->nombre;
            $customer->telefono = $request->telefono;
            $customer->direccion = $request->direccion;
            $customer->save();
            
            foreach ($request->articles as $key) {
                # code...

            $order = new Order;
            $order->product_id = $key['id'];
            $order->customer_id = $customer->id;
            $order->nombre = $key['nombre'];
            $order->precio = $key['precio'];
            $order->presentacion = $key['presentacion'];
            $order->cantidad = $key['cantidad'];
            $order->imagen = $key['imagen'];
            $order->save();

                   
            }

              

            DB::commit();
            event(new StatusLiked('Tienes una nueva orden'));
            return "Gracias! Su pedido a sido enviado en breve le llamaremos.";
           

        } catch (\PDOException $e) {
            // Woopsy
            DB::rollBack();
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
    }
}
