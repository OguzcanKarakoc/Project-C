<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::paginate(5)->onEachSide(3);

        if ($request->ajax()) {
            return view('page.back-end.user.paginate', compact('users'));
        }

        return view('page.back-end.user.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('page.back-end.user.create', compact('roles'));
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
        $userValidatedData = $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role_id' => 'required|int|max:255',
        ]);

        $user = new User();
        $user->first_name = $userValidatedData['first_name'];
        $user->last_name = $userValidatedData['last_name'];
        $user->phone_number = $userValidatedData['phone_number'];
        $user->password = $userValidatedData['password'];
        $user->email = $userValidatedData['email'];
        $user->role_id = $userValidatedData['role_id'];
        $user->save();

        return redirect()->route('users.index')->with('success', 'User created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);


        return view('page.back-end.user.show', compact('user'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('page.back-end.user.edit', compact('user', 'roles'));
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
        $userValidatedData = $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role_id' => 'required|int|max:255',
        ]);


        $user = User::findOrFail($id);
        $user->first_name = $userValidatedData['first_name'];
        $user->last_name = $userValidatedData['last_name'];
        $user->phone_number = $userValidatedData['phone_number'];
        $user->email = $userValidatedData['email'];
        $user->role_id = $userValidatedData['role_id'];
        $user->save();


        return redirect()->route('users.index')->with('success', 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = User::findOrFail($id);
        $supplier->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
