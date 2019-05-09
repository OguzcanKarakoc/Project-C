<?php

namespace App\Http\Controllers;

use App\Address;
use App\Order;
use App\OrderProduct;
use App\OrderStatus;
use App\Product;
use App\Role;
use App\Shipment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // To check if user is logged in
        if (Auth::guard('user')->check()) {
            // Logged in
            $user = Auth::guard('user')->user();

            $orders = $user->orders;

            $shipments = Shipment::all();

            return view('page.front-end.checkout.step2', compact('user', 'shipments'));

        }

        return view('page.front-end.checkout.index');
    }

    public function orderIndex()
    {
        // To check if user is logged in
        if (Auth::guard('user')->check()) {
            // Logged in
            $user = Auth::guard('user')->user();

            $orders = $user->orders;
        }

        return view('page.front-end.order.index', compact('orders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  { 1 : 2, 3: 5 }
        // [ 1 => 2, 3 => 5 ]
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'first_name' => 'required|string|alpha|max:255',
            'last_name' => 'required|string|alpha|max:255',
            'phone_number' => 'required|string|max:255',
            'password' => 'required|string|alpha_num|max:255',
            'email' => 'required|email|max:255',
            'postcode' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'house_number' => 'required|string|max:255',
        ]);

        if (!$role = Role::where('name', '=', 'user')->get()->first()) {
            $role = new Role();
            $role->name = 'user';
            $role->save();
        }

        $user = new User();
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->phone_number = $validatedData['phone_number'];
        $user->password = bcrypt($validatedData['password']);
        $user->email = $validatedData['email'];
        $user->role_id = $role->id;
        $user->save();

        $address = new Address();
        $address->postcode = $validatedData['postcode'];
        $address->city = $validatedData['city'];
        $address->street = $validatedData['street'];
        $address->house_number = $validatedData['house_number'];
        $address->delivery_address = true;
        $address->user_id = $user->id;

        if (!$orderStatus = OrderStatus::where('name', '=', 'In progress')->get()->first()) {
            $orderStatus = new OrderStatus();
            $orderStatus->name = 'In progress';
            $orderStatus->save();
        }

        $order = new Order();
        $order->user_id = $user->id;
        $order->address_id = $address->id;
        $order->order_status_id = $orderStatus->id;
        $order->save();

        $cart = json_decode(Cookie::get('cart'), true);
        $result = [];
        foreach ($cart as $key => $value) {
            if ($product = Product::find($key)) {
                if ($product->quantity > 0) {
                    $orderProduct = new OrderProduct();
                    $orderProduct->product_id = $product->id;
                    $orderProduct->order_id = $order->id;
                    $orderProduct->quantity = $value;
                    $orderProduct->save();
                    $result[] = ['product' => $product, 'quantity' => $value];
                }
            }
        }

        Auth::guard('user')->login($user);
        Cookie::queue(Cookie::forget('cart'));
        return view('page.front-end.checkout.order', compact('result', 'order'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);

        foreach ($order->products as $orderProduct) {
            $result[] = ['product' => $orderProduct->product, 'quantity' => $orderProduct->quantity];
        }

        return view('page.front-end.order.show', compact('result', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
