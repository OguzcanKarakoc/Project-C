<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(15);

        return view('page.front-end.product.index', compact('products'));
    }

    public function show(Product $product)
    {
        // $product = Product::query("SELECT * FROM products WHERE products.id = {{$id}};");

        $quantity = 0;
        $avgRating = null;
        $comment = null;
        $ratings = null;
        if (Cookie::get('cart') !== null) {
            $json = Cookie::get('cart');
            $array = json_decode($json, true);

            if (array_key_exists($product->id, $array)) {
                $quantity = $array[$product->id];
            }
        }
        $rating = null;

        // current users rating
        if (Auth::guard('user')->check()) {
            $rating = Rating::where('user_id', Auth::guard('user')->user()->id)->where('product_id', $product->id)->first();
        }

        $avgRating = $product->ratings()->avg('rating');

        $ratings = $product->ratings()->get();

        return view('page.front-end.product.show', compact('product', 'quantity', 'rating', 'avgRating', 'ratings'));
    }

    public function ajaxPagination(Request $request)
    {
        $categories = Category::all();

        $sqlquery = null;

        if (!empty($request->categories)) {
            $sqlquery = Product::searchFilter(Category::find($request->categories), 'categories', 'category_id', $sqlquery);
        }
        if (!empty($request->price['min']) || !empty($request->price['max'])) {
            $sqlquery = Product::searchFilter($request->price, 'products', 'price', $sqlquery);
        }

        if (!is_null($sqlquery)) {
            $products = $sqlquery->paginate(15);
        } else {
            $products = Product::paginate(15);
        }

        if (!empty($request->search)) {
            $products = Product::search($request->search);
        }

        if ($request->ajax()) {
            return view('page.front-end.product.paginate', compact('products'));
        }

        return view('page.front-end.product.index', compact('products', 'categories'));
    }


}
