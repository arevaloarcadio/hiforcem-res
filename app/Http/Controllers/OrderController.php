<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Item;
use App\Order;
use Auth;

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
        $orders = Order::all();

        return $orders;
    }

    public function ordersIndex()
    {
        //
        $orders = Order::where('ship_id',0)
            ->orWhere('albaran','>',0)
            ->orWhere('factura','>',0)
            ->orWhere('solicitud','>',0)
            ->get();

        return $orders;    
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;
        if($request->cliente){
            $order->user_id = $request->cliente;
        }else{
            $order->user_id = Auth::user()->id;
        }
        $order->creator_id = Auth::user()->id;
        $order->address = request()->address;
        $order->name = request()->name;
        $order->surname = request()->surname;
        $order->razon = request()->razon;
        $order->city = request()->city;
        $order->pc = request()->pc;
        $order->province = request()->province;
        if(isset(request()->ship)){
            $order->ship = request()->ship;
        }else{
            $order->ship = 0;
        }
        $order->shipping_cost = request()->shipping_cost;
        $order->palos = request()->palos;
        $order->comment = request()->comment;
        $order->status = 'pendiente';
        $order->total = request()->total;
        $order->delivery_comission = request()->delivery_comission;
        $order->save();

        $items = Item::where('user_id',$order->user_id)
                ->where('order_id',0)
                ->update(['order_id' => $order->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function read($id)
    {
        //
        return Order::find($id);
    }

    
    public function process($id)
    {

        $maxS = Order::where('id','>',0)
            ->orderBy('solicitud','desc')
            ->first();
        if(empty($maxS->solicitud))
        {
            $maxS->solicitud = 0;
        }

        $order = Order::find($id);
        if(!$order->solicitud){

            $order->solicitud = $maxS->solicitud + 1;
        }
        $order->save();

        $items = Item::where('order_id',$id)->update(['date' => date("Y-m-d")]);


        return response()->json(Order::all());
    }

    
    public function invoice($id)
    {

        $maxA = Order::where('id','>',0)
            ->orderBy('albaran','desc')
            ->first();

        if(!$maxA->albaran)
        {
            $maxA->albaran = 0;
        }
        if(!$maxA->factura)
        {
            $maxA->factura = 0;
        }
        $maxF = Order::where('id','>',0)
            ->orderBy('factura','desc')
            ->first();

        $order = Order::find($id);
        if($order->albaran > 0){
            return response()->json(Order::all());
        }
        $order->albaran = $maxA->albaran + 1;
        $order->factura = $maxA->factura + 1;

        $order->save();

        $items = Item::where('order_id',$id)->update(['date' => date("Y-m-d")]);

        return response()->json(Order::all());

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
      
        $order = Order::find($id);
        $order->fill($request->all());
        $order->last_update = Auth::user()->id;
        $order->save();

        return $order;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::destroy($id);
        return response()->json(['message' => 'Borrado con éxito']);
    }
}
