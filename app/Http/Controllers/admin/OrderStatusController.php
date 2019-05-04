<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderStatuses = OrderStatus::paginate(5)->onEachSide(3);

        return view('page.back-end.orderStatus.index', compact('orderStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.back-end.orderStatus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orderStatusValidatedData = $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $orderStatus = new OrderStatus();
        $orderStatus->name = $orderStatusValidatedData['name'];
        $orderStatus->save();

        return redirect()->route('orderStatuses.index')->with('success', 'Order Status created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $orderStatus = OrderStatus::findOrFail($id);

        return view('page.back-end.orderStatus.edit', compact('orderStatus'));
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
        $orderStatusValidatedData = $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $orderStatus = OrderStatus::findOrFail($id);
        $orderStatus->name = $orderStatusValidatedData['name'];
        $orderStatus->save();

        return redirect()->route('orderStatuses.index')->with('success', 'Order Status updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orderStatus = OrderStatus::findOrFail($id);
        $orderStatus->delete();

        return redirect()->route('orderStatuses.index')->with('success', 'Order Status deleted successfully');
    }
}
