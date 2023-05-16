<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Item;
use App\Order;
use App\Product;
use App\User;
use Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $items = Item::where('user_id','=',Auth::user()->id)
        ->orderBy('created_at','desc')
        ->where('order_id',0)
        ->get();

        return response()->json(['data' => $items, 'weight' => $items->sum('weight'),'total' => $items->sum('total')]);
    }

    public function stats()
    {
        $query = Item::where('date','>',0);

        if(request()->product_id){
            $query->where('product_id', request()->product_id);
        }
        if(request()->category_id){
            $query->where('category_id', request()->category_id);
        }
        if(request()->order){
            $query->where('order_id', request()->order);
        }
        if(request()->start_date){
            $query->whereDate('created_at', '>=',request()->start_date);
        }
        if(request()->final_date){
            $query->whereDate('created_at','<=', request()->final_date);
        }
        $items = $query->get();



        /*
            SIMPLE T
         */
        $stsize = Item::where('date','>',0)
            ->where('category_id','=',6)->get();
        $stsize = $stsize->sum(function ($item) {
            return $item->size * $item->qty;
        });

        $stotal = Item::where('date','>',0)
            ->where('category_id','=',6)
            ->sum('total');

        $stbruto = Item::where('date','>',0)
            ->where('category_id','=',6)
            ->sum('bruto');

        $stcost = Item::where('date','>',0)
            ->where('category_id','=',6)->get();
        $stcost = $stcost->sum(function ($item) {
            return $item->cost * $item->qty;
        });
        /*
            DOBLE T
         */
        $dtsize = Item::where('date','>',0)
            ->where('category_id','=',7)->get();
        $dtsize = $dtsize->sum(function ($item) {
            return $item->size * $item->qty;
        });

        $dtotal = Item::where('date','>',0)
            ->where('category_id','=',7)
            ->sum('total');

        $dtbruto = Item::where('date','>',0)
            ->where('category_id','=',7)
            ->sum('bruto');

        $dtcost = Item::where('date','>',0)
            ->where('category_id','=',7)->get();
        $dtcost = $dtcost->sum(function ($item) {
            return $item->cost * $item->qty;
        });
        /*
            PLACAS
         */
        $plsize = Item::where('date','>',0)
            ->where('category_id','=',5)->get();
        $plsize = $plsize->sum(function ($item) {
            return $item->size * $item->qty;
        });
        $pltotal = Item::where('date','>',0)
            ->where('category_id','=',5)
            ->sum('total');

        $plbruto = Item::where('date','>',0)
            ->where('category_id','=',5)
            ->sum('bruto');

        $plcost = Item::where('date','>',0)
            ->where('category_id','=',5)->get();
        $plcost = $plcost->sum(function ($item) {
            return $item->cost * $item->qty;
        });
        /*
            ARMADAS
         */
        $asize = Item::where('date','>',0)
            ->where('category_id','=',8)->get();
        $asize = $asize->sum(function ($item) {
            return $item->size * $item->qty;
        });
        $atotal = Item::where('date','>',0)
            ->where('category_id','=',8)
            ->sum('total');

        $abruto = Item::where('date','>',0)
            ->where('category_id','=',8)
            ->sum('bruto');

        $acost = Item::where('date','>',0)
            ->where('category_id','=',8)->get();
        $acost = $acost->sum(function ($item) {
            return $item->cost * $item->qty;
        });
        /*
            PERGOLAS
         */
        $pesize = Item::where('date','>',0)
            ->where('category_id','=',3)->get();
        $pesize = $pesize->sum(function ($item) {
            return $item->size * $item->qty;
        });
        $petotal = Item::where('date','>',0)
            ->where('category_id','=',3)
            ->sum('total');

        $pebruto = Item::where('date','>',0)
            ->where('category_id','=',3)
            ->sum('bruto');

        $pecost = Item::where('date','>',0)
            ->where('category_id','=',3)->get();
        $pecost = $pecost->sum(function ($item) {
            return $item->cost * $item->qty;
        });

        return response()->json(['data' => $items, 'weight' => $items->sum('weight'),'total' => $items->sum('total'),
            'stmetros' => $stsize,
            'stotal' => $stotal,
            'stcost' => $stcost,
            'dtmetros' => $dtsize,
            'dtotal' => $dtotal,
            'dtcost' => $dtcost,
            'plmetros' => $plsize,
            'pltotal' => $pltotal,
            'plcost' => $plcost,
            'ametros' => $asize,
            'atotal' => $atotal,
            'acost' => $acost,
            'pemetros' => $pesize,
            'petotal' => $petotal,
            'pecost' => $pecost,
        ]);
    }

    public function itemsByOrder($id)
    {
         $items = Item::where('order_id','=',$id)
        ->orderBy('created_at','desc')
        ->with('category')
        ->get();

        return response()->json(['data' => $items, 'weight' => $items->sum('weight'),'total' => $items->sum('total')]);
    }

    public function itemsByUser($id)
    {
         $items = Item::where('user_id','=',$id)
        ->where('order_id',0)
        ->orderBy('created_at','desc')
        ->get();

        return response()->json(['data' => $items, 'weight' => $items->sum('weight'),'total' => $items->sum('total')]);
    }


    public function printPresupuesto($id)
    {
        $order = Order::findOrFail($id);
        $items = Item::where('order_id','=',$id)
        ->orderBy('created_at','desc')
        ->get();

        foreach ($items as $item ) {
            # code...
            if(isset($item->options) ){
                foreach (json_decode($item->options,"true") as $opt) {
                # code...
                    $item->setAttribute($opt["question"],$opt["value"]);
                }
            }
            
        }

        $weight = $items->sum('weight');
        $size = $items->sum('size');
        $qty = $items->sum('qty');
        $sizes = $size * $qty;
        $user = User::find($order->user_id);
        $bruto = $items->sum('bruto');

        $pdf = PDF::loadView('print.presupuesto',['order' => $order,'items' => $items,'user' => $user, 'weight' => $weight,'size' => $sizes,'bruto' => $bruto])->setPaper('a4','portrait');
        return $pdf->download('presupuesto.pdf');
    }

    public function printPedido($id)
    {
        $order = Order::findOrFail($id);
        $items = Item::where('order_id','=',$id)
        ->orderBy('created_at','desc')
        ->get();

        foreach ($items as $item ) {
            # code...
            if(isset($item->options) ){
                foreach (json_decode($item->options,"true") as $opt) {
                # code...
                    $item->setAttribute($opt["question"],$opt["value"]);
                }
            }
            
        }
        $weight = $items->sum('weight');
        $size = $items->sum('size');
        $qty = $items->sum('qty');
        $sizes = $size * $qty;
        $user = User::find($order->user_id);
        $bruto = $items->sum('bruto');

        $pdf = PDF::loadView('print.pedido',['order' => $order,'items' => $items,'user' => $user, 'weight' => $weight,'size' => $sizes,'bruto' => $bruto])->setPaper('a4','portrait');
        return $pdf->download('pedido.pdf');
    }

    public function printAlbaran($id)
    {
        $order = Order::findOrFail($id);
        $items = Item::where('order_id','=',$id)
        ->orderBy('created_at','desc')
        ->get();

        foreach ($items as $item ) {
            # code...
            if(isset($item->options) ){
                foreach (json_decode($item->options,"true") as $opt) {
                # code...
                    $item->setAttribute($opt["question"],$opt["value"]);
                }
            }
            
        }
        $weight = $items->sum('weight');
        $size = $items->sum('size');
        $qty = $items->sum('qty');
        $sizes = $size * $qty;
        $user = User::find($order->user_id);
        $bruto = $items->sum('bruto');

        $pdf = PDF::loadView('print.albaran',['order' => $order,'items' => $items,'user' => $user, 'weight' => $weight,'size' => $sizes,'bruto' => $bruto])->setPaper('a4','portrait');
        return $pdf->download('documento.pdf');
    }

    public function printInvoice($id)
    {
        $order = Order::findOrFail($id);
        $items = Item::where('order_id','=',$id)
        ->orderBy('created_at','desc')
        ->get();

        foreach ($items as $item ) {
            # code...
            if(isset($item->options) ){
                foreach (json_decode($item->options,"true") as $opt) {
                # code...
                    $item->setAttribute($opt["question"],$opt["value"]);
                }
            }
            
        }

        $weight = $items->sum('weight');
        $size = $items->sum('size');
        $qty = $items->sum('qty');
        $sizes = $size * $qty;
        $user = User::find($order->user_id);
        $bruto = $items->sum('bruto');

        $pdf = PDF::loadView('print.factura',['order' => $order,'items' => $items,'user' => $user, 'weight' => $weight,'size' => $sizes,'bruto' => $bruto])->setPaper('a4','portrait');
        return $pdf->download('Factura.pdf');
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
        $item = new Item();
        $item = fill($request->all());

        $item->save();
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
    public function edit(Request $request,$id)
    {
        $item = Item::find($id);
        $user = User::find($item->user_id);
        
        if($request->remove_discount == true){
             $item->discount = 0;
        }
        
        if($request->qty > 0){
            $qty = $request->qty;
            $price = $item->total / $item->size / $item->qty;
            $priceEnvio = $item->totalEnvio / $item->size / $item->qty;
            $weight = $item->weight / $item->size / $item->qty;

            $item->weight = $item->size * $weight * $qty;
            $item->total = $item->size * $price * $qty;
            $item->totalEnvio = $item->total * ($user->delivery_comission / 100 + 1);
            $item->qty = $qty;
        }elseif($request->PM > 0){
            $order = Order::find($item->order_id);
            $qty = $request->qty;
            if($order->ship){
                $price = $request->PM /  ($user->delivery_comission / 100 + 1);
            }else{
                $price = $request->PM;
            }
            $weight = $item->weight / $item->size / $item->qty;
            

            $item->weight = $item->size * $weight * $item->qty;
            $item->total = $item->size * $price * $item->qty;
            $item->totalEnvio = $item->total * ($user->delivery_comission / 100 + 1);
            
        }elseif($request->product_id > 0){
            $item->product_id = $request->product_id;
            $item->title = Product::find($request->product_id)->title;
        }
        
        $item->save();

        if($request->order){
            $items = Item::where('order_id','=',$request->order)
            ->orderBy('created_at','desc')
            ->with('category')
            ->get();
            $refresh = Order::find($request->order);
            $refresh->total = $items->sum('total');
            $refresh->save();
        }else{
            $items = Item::where('user_id','=',$item->user_id)
            ->orderBy('created_at','desc')
            ->where('order_id',0)
            ->with('category')
            ->get();
        }
        

        return response()->json(['data' => $items, 'weight' => $items->sum('weight'),'total' => $items->sum('total')]);
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
    public function destroy($id,$order = 0)
    {
        $borrar = Item::find($id);
        Item::destroy($id);
        
        if(request()->order){
            $ord = Order::find(request()->order);
            $items = Item::where('user_id','=',$ord->user_id)
                ->where('order_id',request()->order)
                ->orderBy('created_at','desc')
                ->get();
            $refresh = Order::find(request()->order);
            $refresh->total = $items->sum('total');
            $refresh->save();
        }else{
            $items = Item::where('user_id','=',$borrar->user_id)
                ->where('order_id',0)
                ->orderBy('created_at','desc')
                ->get();
        }

        

        return response()->json(['data' => $items, 'weight' => $items->sum('weight'),'total' => $items->sum('total')]);
    }
}
