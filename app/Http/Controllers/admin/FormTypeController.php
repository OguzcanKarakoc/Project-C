<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\FormType;
use Illuminate\Http\Request;

class FormTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formTypes = FormType::paginate(5)->onEachSide(3);

        return view('page.back-end.formType.index', compact('formTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.back-end.formType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formTypeValidatedData = $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $formType = new FormType();
        $formType->name = $formTypeValidatedData['name'];
        $formType->save();

        return redirect()->route('formTypes.index')->with('success', 'Form Type created');
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
        $formType = FormType::findOrFail($id);

        return view('page.back-end.formType.edit', compact('formType'));
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
        $formTypeValidatedData = $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $formType = FormType::findOrFail($id);
        $formType->name = $formTypeValidatedData['name'];
        $formType->save();

        return redirect()->route('formTypes.index')->with('success', 'Form Type updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $formType = FormType::findOrFail($id);
        $formType->delete();

        return redirect()->route('formTypes.index')->with('success', 'Form Type deleted successfully');
    }
}
