<?php

namespace App\Http\Controllers;

use App\Favorites;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recent_products = Product::latest()->take(15)->get();

        $popular_products = Product::where("price", '>', 50)->take(15)->get();

        $highlight = Product::all()->random(1)->first();

        return view('page.front-end.home.index', compact('recent_products', 'popular_products', 'highlight'));
    }


    public function add(Request $request)
    {
        if (Auth::guard('user')->check()) {
            $product_id = Input::get('product_id');
            $user_id = Auth::guard('user')->user()->id;
            if ( Favorites::where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->exists() )
            {
                Session::flash('message1', 'Product is already in your Favorites!');
                return redirect()->back();

//                return response()->json([
//                    'name' => 'Product is already in your Favorites!',
//                    'state' => 'error'
//                ]);


            }
            else {
                DB::table('favorites')->insert(
                    ['user_id' => $user_id, 'product_id' => $product_id]);
                Session::flash('message2', 'Product added to your Favorites!');
                return redirect()->back();
            }
        }
        else {
            Session::flash('message3', 'You are not logged in');
            return redirect()->back();
        }
    }

    public function getFavorites()
    {
        if (Auth::guard('user')->check()) {
            $user_id = Auth::guard('user')->user()->id;
            $products = DB::table('favorites')
                -> join ('products', 'favorites.product_id', '=', 'products.id')
//              -> join ('product_images', 'favorites.product_id', '=', 'product_images.product_id')
                -> where ('user_id', $user_id)
                ->get();

            return view('page.front-end.favorites.index', compact('products'));
        }
        else {
            Session::flash('message3', 'You are not logged in');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $user_id = Auth::guard('user')->user()->id;
        DB::table('favorites')
            ->where('user_id', '=', $user_id)
            ->where('product_id', '=', $id)
            ->delete();
        Session::flash('message4', 'Product removed from your Favorites!');
        return redirect()->back();
    }
}
