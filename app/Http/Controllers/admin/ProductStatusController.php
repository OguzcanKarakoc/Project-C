<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\ProductStatus;
use Illuminate\Http\Request;

class ProductStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productStatuses = ProductStatus::paginate(5)->onEachSide(3);

        return view('page.back-end.productStatus.index', compact('productStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.back-end.productStatus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productStatusValidatedData = $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $productStatus = new ProductStatus();
        $productStatus->name = $productStatusValidatedData['name'];
        $productStatus->save();

        return redirect()->route('productStatuses.index')->with('success', 'Product Status created');
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
        $productStatus = ProductStatus::findOrFail($id);

        return view('page.back-end.productStatus.edit', compact('productStatus'));
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
        $productStatusValidatedData = $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $productStatus = ProductStatus::findOrFail($id);
        $productStatus->name = $productStatusValidatedData['name'];
        $productStatus->save();

        return redirect()->route('productStatuses.index')->with('success', 'Product Status updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productStatus = ProductStatus::findOrFail($id);
        $productStatus->delete();

        return redirect()->route('productStatuses.index')->with('success', 'Product Status deleted successfully');
    }
}
