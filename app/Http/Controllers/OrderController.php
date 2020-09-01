<?php

namespace App\Http\Controllers;
use App\Events\StatusLiked;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Order;
use App\Detail;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
         
           
           try {
            DB::beginTransaction();
            // database queries here
     
            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->address = $request->address;
            $order->save();
            
            
            foreach ($request->article as $key) {
                # code...

            $detail = new Detail;
            $detail->order_id = $order->id;
            $detail->product_id = $key['id'];
            $detail->precio = $key['precio'];
            $detail->cantidad = $key['cantidad'];
            $detail->save();
       
            }
 

            DB::commit();
           /* event(new StatusLiked('Tienes una nueva orden'));
            return "Gracias! Su pedido a sido enviado en breve le llamaremos.";
           */

          return "ok";

        } catch (\PDOException $e) {
            // Woopsy
            DB::rollBack();
            return $e;
        }

       

       

       
     
          # code...
         
             # code...
           
        
      
      
       
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
