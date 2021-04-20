<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\NewShop;

class ShopController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $shops = Shop::all();
        return view('shop.index', compact('shops'));
    }

    public function create()
    {
        return view('shop.create');
    }

    public function store(Request $request)
    {
        // validate request
        $data = $request->validate([
            'title' => 'required|string|between:3,100|unique:shops,title',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'telephone' => 'required|string|size:11',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,name',
            'address' => 'nullable',
        ]);

        // create user in db
        $randomPass = rand(1000, 9999);
        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'role' => 'shop',
            'email_verified_at' => now(),
            'password' => bcrypt($randomPass),
        ]);

        // create shop in db
        Shop::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'telephone' => $request->telephone,
            'address' => $request->address,
        ]);

        // notify user
        $user->notify(new NewShop($user->email, $randomPass));

        // redirect
        return redirect()->route('shop.index')->withMessage( __('SUCCESS') );
    }

    public function show(Shop $shop)
    {
        //
    }

    public function edit(Shop $shop)
    {
        //
    }

    public function update(Request $request, Shop $shop)
    {
        //
    }

    public function destroy(Shop $shop)
    {
        //
    }
}
