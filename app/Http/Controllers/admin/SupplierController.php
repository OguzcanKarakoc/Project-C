<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers = Supplier::paginate(5)->onEachSide(3);

        if ($request->ajax()) {
            return view('page.back-end.supplier.paginate', compact('suppliers'));
        }

        return view('page.back-end.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('page.back-end.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $supplierValidatedData = $this->validate($request, [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        //dd($supplierValidatedData);

        $supplier = new Supplier();
        $supplier->full_name = $supplierValidatedData['full_name'];
        $supplier->email = $supplierValidatedData['email'];
        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'Supplier created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = supplier::findOrFail($id);

        return view('page.back-end.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $supplierValidatedData = $this->validate($request, [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);


        $supplier = Supplier::findOrFail($id);
        $supplier->full_name = $supplierValidatedData['full_name'];
        $supplier->email = $supplierValidatedData['email'];
        $supplier->save();

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully');
    }
}
