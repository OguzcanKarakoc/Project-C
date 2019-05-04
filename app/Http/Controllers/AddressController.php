<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.front-end.user.address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, $id)
    {
        $validatedData = $this->validate($request, [
            'street' => 'required|string|max:255',
            'house_number' => 'required|int|max:255',
            'postcode' => 'required|string|max:255',
            'city' => 'required|string|max:255',
        ]);

        $address = new Address();
        $address->user_id = Auth::guard('user')->user()->id;
        $address->street = $validatedData['street'];
        $address->house_number = $validatedData['house_number'];
        $address->postcode = $validatedData['postcode'];
        $address->city = $validatedData['city'];
        $address->delivery_address = false;
        $address->save();

        return redirect()->route('profile.index')->with('success', 'Address created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id, $id)
    {
        $address = Address::find($id);
        return view('page.front-end.user.address.edit', compact('address', 'user_id'));
    }


    public function update(Request $request, $user_id, $id)
    {
        $validatedData = $this->validate($request, [
            'street' => 'required|string|max:255',
            'house_number' => 'required|int',
            'postcode' => 'required|string',
            'city' => 'required|string|max:255',
        ]);

        $address = Address::findOrFail($id);
        $address->user_id = Auth::guard('user')->user()->id;
        $address->street = $validatedData['street'];
        $address->house_number = $validatedData['house_number'];
        $address->postcode = $validatedData['postcode'];
        $address->city = $validatedData['city'];
        $address->delivery_address = false;
        $address->save();

        return redirect()->route('profile.index')->with('success', 'Address updated');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        return redirect()->route('profile.index')->with('success', 'Address deleted successfully');
    }
}
