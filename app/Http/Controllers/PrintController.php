<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests;
use App\Order;
use App\Item;


class PrintController extends Controller{

    public function getPrintOrder(Request $request, $id)
    {
        $order = Order::where('id', "=", $id)->firstOrFail();
        $items = Item::where('order_id', '=', $id)->get();

        $pdf = PDF::loadView('print.factura',['order' => $order,'items' => $items])->setPaper('a4','portrait');
        return $pdf->download('documento.pdf');
    }
    public function getPrintAlbaran(Request $request, $id)
    {
        $order = Order::where('id', "=", $id)->firstOrFail();
        $items = Item::where('order_id', '=', $id)->get();
        // dd($items);
        $pdf = PDF::loadView('print.albaran',['order' => $order,'items' => $items])->setPaper('a4','portrait');
        return $pdf->download('documento.pdf');
    }

    public function getPrintPedido(Request $request, $id)
    {
        $order = Order::where('id', "=", $id)->firstOrFail();
        $items = Item::where('order_id', '=', $id)->get();
        // dd($items);
        $pdf = PDF::loadView('print.pedido',['order' => $order,'items' => $items])->setPaper('a4','portrait');
        return $pdf->download('documento.pdf');
    }
    public function getPrintPresupuesto(Request $request, $id)
    {
        $order = Order::where('id', "=", $id)->firstOrFail();
        $items = Item::where('order_id', '=', $id)->get();
        foreach ($items as $item) {
            # code...
            $item->setAttribute('Punta','siii');
        }
        
        $pdf = PDF::loadView('print.presupuesto',['order' => $order,'items' => $items])->setPaper('a4','portrait');
        return $pdf->download('documento.pdf');
    }

    public function getPrintLabel()
    {
        return view('print.label');
    }
    public function postPrintLabel(Request $request)
    {
        // dd($items);
        $items = $request->input();
        $pdf = PDF::loadView('print.pegatina',['items' => $items])->setPaper('a4','portrait');
        return $pdf->download('documento.pdf');
    }

}