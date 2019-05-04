<?php

namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cookie::get('cart');
        $products = [];
        if ($cart !== null) {
            $cart = json_decode($cart, true);
            foreach ($cart as $product_id => $quantity) {
                if ($product = Product::find($product_id)) {
                    $products[] = ['quantity' => $quantity, 'product' => $product];
                }
            }
        }

        return view('page.front-end.cart.index', compact('products'));
    }

    // region: ajax calls
    public function addToCart(Request $request)
    {
        if (!empty($request->product_id)) {
            $product_id = $request->product_id;
            if (Cookie::get('cart') !== null) {
                $json = Cookie::get('cart');
                if (Product::find($product_id)) {
                    $array = json_decode($json, true);
                    if (array_key_exists($product_id, $array)) {
                        $array[$product_id]++;
                    } else {
                        $array[$product_id] = 1;
                    }
                    Cookie::queue('cart', json_encode($array));
                    return response()->json([
                        'name' => 'Product added',
                        'state' => 'success'
                    ]);
                }
                return response()->json([
                    'name' => 'Product couldn\'t be added',
                    'state' => 'error'
                ]);
            } else {
                if (Product::find($product_id)) {
                    Cookie::queue('cart', json_encode([$product_id => 1]));
                    return response()->json([
                        'name' => 'Product added',
                        'state' => 'success'
                    ]);
                }
            }
        }

        return response()->json([
            'name' => 'Product not set',
            'state' => 'error'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCart(Request $request)
    {
//        $cart = [ {product_id} => {quantity} ];
        if (!empty($request->product_id) && !empty($request->quantity)) {
            $product_id = $request->product_id;
            if (Cookie::get('cart') !== null) {
                $json = Cookie::get('cart');
                if ($product = Product::find($product_id)) {
                    if ($request->quantity < $product->quantity && !($request->quantity <= 0)) {
                        $array = json_decode($json, true);
                        $array[(int)$product_id] = (int)$request->quantity;

                        $total = 0;
                        foreach ($array as $key => $quantity) {
                            if ($product = Product::find($key)) {
                                $total = $total + ($product->price * $quantity);
                            }
                        }

                        Cookie::queue('cart', json_encode($array));
                        return response()->json([
                            'name' => 'Product Added',
                            'price' => $product->price * (int)$request->quantity,
                            'total' => $total,
                            'state' => 'success'
                        ]);
                    } else {
                        if ($request->quantity <= 0) {
                            return response()->json([
                                'name' => 'Invalid input',
                                'state' => 'error'
                            ]);
                        }
                        return response()->json([
                            'name' => 'Not enough in stock',
                            'state' => 'error'
                        ]);
                    }
                }
                return response()->json([
                    'name' => 'Product couldn\'t be updated',
                    'state' => 'error'
                ]);
            } else {
                if ($product = Product::find($product_id)) {
                    Cookie::queue('cart', json_encode([$product_id => 1]));
                    $total = 0;
                    return response()->json([
                        'name' => 'Product Updated',
                        'price' => $product->price,
                        'total' => $total,
                        'state' => 'success'
                    ]);
                }
            }
        }

    }

    public function getCart()
    {
        if (Cookie::get('cart') !== null) {
            $json = Cookie::get('cart');
            return $json;
        }

    }

    public function destroy(Request $request)
    {
        if (Cookie::get('cart') !== null) {
            if (!empty($request->product_id)) {
                $json = Cookie::get('cart');
                if (Product::find($request->product_id)) {
                    $array = json_decode($json, true);
                    if (array_key_exists($request->product_id, $array)) {
                        unset($array[$request->product_id]);
                    }
                    Cookie::queue('cart', json_encode($array));
                    return 'Product deleted';
                }
                return 'Couldn\'t deleted product ';
            }
        }

        return 'Cart doesn\'t exist';
    }
    // endregion
}
