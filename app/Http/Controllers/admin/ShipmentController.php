<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shipment;
class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shipments =Shipment::paginate(5)->onEachSide(3);

        if ($request->ajax()) {
            return view('page.back-end.shipment.paginate', compact('shipments'));
        }

        return view('page.back-end.shipment.index', compact('shipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.back-end.shipment.create');
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
        $shipmentValidatedData = $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|max:255',
        ]);

        $shipment = new Shipment();
        $shipment->name = $shipmentValidatedData['name'];
        $shipment->price = $shipmentValidatedData['price'];
        $shipment->save();

        return redirect()->route('shipments.index')->with('success', 'Shipment created');
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
        $shipment = Shipment::findOrFail($id);

        return view('page.back-end.shipment.edit', compact('shipment'));
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
        $shipmentValidatedData = $this->validate($request, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|max:255',
        ]);

        $shipment = Shipment::find($id);
        $shipment->name = $shipmentValidatedData['name'];
        $shipment->price = $shipmentValidatedData['price'];
        $shipment->save();

        return redirect()->route('shipments.index')->with('success', 'Shipment updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipment = Shipment::findOrFail($id);
        $shipment->delete();

        return redirect()->route('shipments.index')->with('success', 'Shipment deleted successfully');
    }
}
