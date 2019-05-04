<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::paginate(5)->onEachSide(3);

        if ($request->ajax()) {
            return view('page.back-end.role.paginate', compact('tags'));
        }

        return view('page.back-end.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.back-end.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roleValidatedData = $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $role = new Role();
        $role->name = $roleValidatedData['name'];
        $role->save();

        return redirect()->route('roles.index')->with('success', 'Role created');
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
        $role = Role::findOrFail($id);

        return view('page.back-end.role.edit', compact('role'));
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
        $roleValidatedData = $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $role = Role::findOrFail($id);
        $role->name = $roleValidatedData['name'];
        $role->save();

        return redirect()->route('roles.index')->with('success', 'Role updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }
}
