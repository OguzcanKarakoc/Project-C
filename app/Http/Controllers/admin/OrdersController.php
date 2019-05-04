<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderStatus;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::paginate(5)->onEachSide(3);

        if ($request->ajax()) {
            return view('page.back-end.order.paginate', compact('orders'));
        }

        return view('page.back-end.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        return view('page.back-end.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return view('page.back-end.order.show', compact('order', 'result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $orderStatuses = OrderStatus::all();
        return view('page.back-end.order.edit', compact('order', 'orderStatuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {

        $validatedData = $this->validate($request, [
            'order' => 'required|integer',
            'orderStatus' => 'required|integer',
        ]);

        $order = Order::find($id);
        $order->order_status_id = $request->orderStatus;

        $order->save();

        return redirect()->route('orders.index')->with('success', 'OrderStatus updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');

    }
}
