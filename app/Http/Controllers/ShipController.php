<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ship;
use App\Order;
use App\Item;
use Auth;

class ShipController extends Controller
{

    public function index()
    {
        //
        $ships = Ship::all();

        return $ships;
    }


    public function create()
    {
        
    }

    
    public function store(Request $request)
    {
        $ship = new Ship;
        $ship->fill($request->all());
        $ship->save();

        if($ship->order1){
            $order = Order::find($ship->order1);
            $order->transporter = $ship->transporter ?? "";
            $order->matricula = $ship->matricula ?? "";
            $order->remolque = $ship->remolque ?? "";
            $order->shipping_cost = $ship->shipping_cost ?? 0;
        }
        if($ship->order2){
            $order = Order::find($ship->order2);
            $order->transporter = $ship->transporter ?? "";
            $order->matricula = $ship->matricula ?? "";
            $order->remolque = $ship->remolque ?? "";
            $order->shipping_cost = $ship->shipping_cost ?? 0;
        }
        if($ship->order3){
            $order = Order::find($ship->order3);
            $order->transporter = $ship->transporter ?? "";
            $order->matricula = $ship->matricula ?? "";
            $order->remolque = $ship->remolque ?? "";
            $order->shipping_cost = $ship->shipping_cost ?? 0;
        }
        if($ship->order4){
            $order = Order::find($ship->order4);
            $order->transporter = $ship->transporter ?? "";
            $order->matricula = $ship->matricula ?? "";
            $order->remolque = $ship->remolque ?? "";
            $order->shipping_cost = $ship->shipping_cost ?? 0;
        }
        return $ship;

    }


    public function read($id)
    {
        //
        return Ship::find($id);
    }



    public function update(Request $request, $id)
    {
        $ship = Ship::find($id);
        $ship->fill($request->all());

        if($request->order1 OR $request->order2 OR $request->order3 OR $request->order4) {
            $orders = Item::where('order_id',$request->order1)
                ->orWhere('order_id',$request->order2)
                ->orWhere('order_id',$request->order3)
                ->orWhere('order_id',$request->order4)
                ->sum('weight');
            $ship->weight = $orders;
        }
        $ship->save();

        if($request->order1 > 0){
            $order1 = Order::find($request->order1);
            $order1->ship_id = $id;
            $order1->transporter = $ship->transporter ?? "";
            $order1->matricula = $ship->matricula ?? "";
            $order1->remolque = $ship->remolque ?? "";
            $order1->shipping_cost = $ship->shipping_cost ?? 0;
            $order1->save();
        }elseif($order1 = Order::find($request->order1)){
            $order1->ship_id = 0;
            $order1->save();
        }

        if($request->order2 > 0){
            $order2 = Order::find($request->order2);
            $order2->ship_id = $id;
            $order2->save();
        }elseif($order2 = Order::find($request->order2)){
            $order2->ship_id = 0;
            $order2->save();
        }

        if($request->order3 > 0){
            $order3 = Order::find($request->order3);
            $order3->ship_id = $id;
            $order3->save();
        }elseif($order3 = Order::find($request->order3)){
            $order3->ship_id = 0;
            $order3->save();
        }

        if($request->order4 > 0){
            $order4 = Order::find($request->order4);
            $order4->ship_id = $id;
            $order4->save();
        }elseif($order4 = Order::find($request->order4)){
            $order4->ship_id = 0;
            $order4->save();
        }

        return $ship;
    }


    public function destroy($id)
    {
        Ship::destroy($id);
        return response()->json(['message' => 'Borrado con éxito']);
    }

    public function getWeights(Request $request)
    {

        if($request->order1 OR $request->order2 OR $request->order3 OR $request->order4) {
            $orders = Item::where('order_id',$request->order1)
                ->orWhere('order_id',$request->order2)
                ->orWhere('order_id',$request->order3)
                ->orWhere('order_id',$request->order4)
                ->sum('weight');
        }

        return $orders;

    }
}
