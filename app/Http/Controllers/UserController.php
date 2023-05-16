<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Discount;
use Auth;

class UserController extends Controller
{
	public function show(Request $request)
	{
		return $request->user();
	}

	public function authUser()
	{
		return Auth::user();
	}

	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();

        return $users;
    }
    public function getComercials()
    {
        //
        $users = User::where('comercial',1)->get();

        return $users;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['message' => 'Borrado con éxito']);
    }

    public function search()
    {
        //
        $search = request()->search;
        $users = User::orWhere('name', 'LIKE','%' .  $search. '%')
            ->orWhere( 'surname', 'LIKE','%' .  $search. '%')
            ->orWhere( 'pc', 'LIKE', '%' . $search. '%')
            ->orWhere( 'NIF', 'LIKE', '%' . $search. '%')
            ->orWhere( 'city', 'LIKE','%' .  $search. '%')
            ->orWhere( 'email', 'LIKE','%' .  $search. '%')
            ->get();

        return $users;
    }


    public function read($id)
    {
        //
        $user = User::findOrFail($id);
        $discounts = $user->discounts;
        $discounts2 = $discounts->map(function ($item) {
    		$item->product_id = $item->product->title;
    		return $item;
		});

		return response()->json(['user' => $user,'discounts' => $discounts2]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->fill(request()->all());
        $user->password = bcrypt(request()->password);
        $user->save();

        return $user;
    }

    public function storeDiscount(Request $request)
    {
        $discount = new Discount();
        $discount->fill(request()->all());
        $discount->save();

        $user = User::findOrFail(request()->user_id);
        $discounts = $user->discounts;
        $discounts2 = $discounts->map(function ($item) {
    		$item->product_id = $item->product->title;
    		return $item;
		});

        return response()->json(['msg' => 'Salvado Correctamente', 'discounts' => $discounts2]);
    }



	public function updateProfile(Request $request)
	{
		$user = User::findOrFail(request()->id);
		if(request()->password){
			$user->fill(request()->all());
			$user->password = bcrypt(request()->password);
		}else{
			$user->fill(request()->except('password'));
		}
		$user->save();

		return response()->json(compact('user'));
	}

	public function updatePassword(Request $request)
	{
		$rules = [
			'new_password'         => 'required',
			'confirm_new_password' => 'required|same:new_password'
		];

		$this->validate($request, $rules);

		$user = $request->user();
		$user->password = bcrypt($request->input('new_password'));
		$user->saveOrFail();

		return response()->json(compact('user'));
	}

	public function delDiscount($id){
		$discount = Discount::destroy($id);

		$discounts = User::findOrFail(request()->user_id)->discounts;
		return response()->json(['msg' => 'Borrado con éxito','discounts' => $discounts]);
	}
}