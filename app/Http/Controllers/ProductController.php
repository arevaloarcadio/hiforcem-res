<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Item;
use App\Order;
use App\User;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json( Product::where('id','>',0)->with('category')->get());
    }


    public function read($id)
    {
        //
        $product = Product::findOrFail($id);
        $parent = Category::where('id',$product->category_id)->first();
        if($parent){
            $product->parent_id = $parent->parent_id;
        }

        return response()->json(['product' => $product]);
    }

    public function getProducts($id = 0)
    {
        return Product::where('category_id','=',$id)
        ->with('category')
        ->get();

    }

    public function getAllProducts()
    {
        $categorias = Category::All();
        $productos = [];
        foreach ($categorias as $categoria ) {
            $productos[$categoria->id] = Product::where('category_id','=',$categoria->id)->get();
        }        
        return $productos;

    }

    public function show(){

    }

    public function getBySize($id,$size,$qty,$order = 0,$user = 0)
    {
        
        $product = Product::where('category_id','=',$id)
            ->where('max_size','>=',$size)
            ->orderBy('max_size','asc')
            ->first();
        $item = new Item();
        $item->options = request()->options;
        $item->category_id = $id;
        $item->product_id = $product->id;
        $item->cost = $product->cost;
        $item->title = $product->title;
        if($order > 0){
            $ord = Order::find($order);
            $item->user_id= $ord->user_id;
        }else if($user != 0){
            $item->user_id = $user;
        }else{
            $item->user_id = Auth::user()->id;
        }


        $item->size = $size;
        $item->bruto = $size * $product->price * $qty;
        if($order > 0){
            if(User::find($ord->user_id)->discounts()->where('product_id',$product->id)->exists()){
                $discount = User::find($ord->user_id)->discounts()->where('product_id',$product->id)->firstOrFail();
                
                $item->total = $item->bruto - ($discount->discount / 100 * $item->bruto);
                $item->discount = $discount->discount;

            }else{
                $item->total = $item->bruto;
                $item->discount = 0;
            }
        }else if($user){
            if(User::find($user)->discounts()->where('product_id',$product->id)->exists()){
                $discount = User::find($user)->discounts()->where('product_id',$product->id)->firstOrFail();
                
                $item->total = $item->bruto - ($discount->discount / 100 * $item->bruto);
                $item->discount = $discount->discount;

            }else{
                $item->total = $item->bruto;
                $item->discount = 0;
            }
        }else{
            if(Auth::user()->discounts()->where('product_id',$product->id)->exists()){
                $discount = Auth::user()->discounts()->where('product_id',$product->id)->firstOrFail();
                $item->total = $item->bruto - ($discount->discount / 100 * $item->bruto);
                $item->discount = $discount->discount;

            }else{
                $item->total = $item->bruto;
                $item->discount = 0;
            }
        }
        
        /////////////////////////
        //// AGREGAMOS EL PORCENTAJE DE ENVIO
        //////////////////////////

        $envio = User::find($item->user_id)->delivery_comission;
        $item->totalEnvio = ($envio / 100 +1) * $item->total;

        /////////////////////////////
        $item->weight = $size * $product->weight * $qty;
        $item->qty = $qty;
        $item->order_id = $order;
        $item->save();


        //meter if para que valga al editar pedido
        if($order){
            $items = Item::where('order_id',$order)
                ->orderBy('created_at','desc')
                ->get();
            $refresh = Order::find($order);
            $refresh->total = $items->sum('total');
            $refresh->save();
            
        }else if($user){
            $items = Item::where('order_id',$order)
                ->where('user_id',$user)
                ->orderBy('created_at','desc')
                ->get();
            
        }else{
            $items = Item::where('user_id',Auth::user()->id)
                ->where('order_id',0)
                ->orderBy('created_at','desc')
                ->get();
        }
        

        return response()->json(['data' => $items, 'weight' => $items->sum('weight'),'total' => $items->sum('total')]);
    }


    public function add(Request $request)
    {
        //
        $product = new Product();
        $product->fill(request()->all());
        $product->slug = str_slug(request()->title);
        $product->save();

        return $product;
    }


    public function update(Request $request)
    {
        $product = Product::findOrFail(request()->id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->weight = $request->weight;
        $product->cost = $request->cost;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->max_size = $request->max_size;
        
        $product->save();

        return response()->json(compact('product'));
    }



}
