<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\OrderStatus;
use App\Product;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    public function store(Request $request)
    {

        if (!$orderStatus = OrderStatus::where('name', '=', 'In progress')->get()->first()) {
            $orderStatus = new OrderStatus();
            $orderStatus->name = 'In progress';
            $orderStatus->save();
        }

        if (isset($request->address_id)) {
            // To check if user is logged in
            if (Auth::guard('user')->check()) {
                // Logged in
                $user = Auth::guard('user')->user();

                $order = new Order();
                $order->user_id = $user->id;
                $order->address_id = $request->address_id;
                $order->order_status_id = $orderStatus->id;
                $order->shipment_id = $request->shipment_id;
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
                            $product->quantity = $product->quantity - $value;
                            $product->save();
                            $result[] = ['product' => $product, 'quantity' => $value];
                        }
                    }
                }

                $orderDate = new DateTime();
                try {
                    $orderDate->add(new DateInterval('PT1H'));
                } catch (\Exception $e) {
                }


                $userNameF = Auth::guard('user')->user()->first_name;
                $userNameL = Auth::guard('user')->user()->last_name;
                $data = array('order' => $order, 'result' => $result, 'first_name' => $userNameF, 'last_name' => $userNameL, 'date' => $orderDate);
                Mail::send('emails.mailorder', $data, function ($message) {
                    $userAdress = Auth::guard('user')->user()->email;
                    $message->from('example@gmail.com', 'GameShop HR Department');
                    $message->subject('Order Confirmation');
                    $message->to($userAdress);
                });

            }
            Cookie::queue(Cookie::forget('cart'));
            Session::flash('message1', 'Your purchase is complete!');

            return redirect()->route('order.show', ['id' => $orderProduct->order_id]);
        }

        Session::flash('message2', 'Please create an address!');

        return redirect()->route('cart.index');
    }
}

