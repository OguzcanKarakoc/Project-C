<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $user = new User();
            $user->first_name = $data['first_name'];
            $user->Last_name = $data['last_name'];
            $user->email = $data['email'];
            $user->phone_number = $data['phone_number'];
            $user->password = bcrypt($data['password']);
            $user->role_id = 2;
            $user->save();

            $mail = $request->input('email');
            $name = $request->input('first_name');
            $data = array('username' => $name, 'email' => $mail);
            Mail::send('emails.mailregister', $data, function ($message) use ($mail) {
                $message->from('gameshop@example.com', 'GameShop HR Department');
                $message->subject('Account Registration');
                $message->to($mail);
            });
            Session::flash('success', 'Account created!');
            return redirect()->back();
            // return redirect()->route('user.register')->with('success', 'Account created');
        }
        return view('page.front-end.user.registration');
    }

    public function signin(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            if (Auth::guard('user')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                if ($request->server('HTTP_REFERER') == "http://127.0.0.1:8000/checkout/order") {
                    return redirect(route('order.index'))->with('flash_message_success', 'Signed in');
                }
                return redirect('/home')->with('success', 'Signed in');
            } else {
                return redirect()->back()->with('error', 'Invalid Username or Password');
            }
        }
        return view('page.front-end.user.signin');
    }

    public function index()
    {
        $user = Auth::guard('user')->user();

        return view('page.front-end.user.show', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        return view('');
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
        return view('page.front-end.user.edit', compact('user'));

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
            'password' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
        ]);


        $user = User::findOrFail($id);
        $user->first_name = $userValidatedData['first_name'];
        $user->last_name = $userValidatedData['last_name'];
        $user->phone_number = $userValidatedData['phone_number'];
        $user->email = $userValidatedData['email'];
        if (isset($userValidatedData['password']) && $userValidatedData['password'] != null) {
            $user->password = bcrypt($userValidatedData['password']);
        }
        $user->save();

        return redirect()->route('profile.index')->with('success', 'User updated');
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
