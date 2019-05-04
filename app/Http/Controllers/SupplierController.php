<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Supplier;

class SupplierController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(string $email){
        //Validate if email contains 'contact@' or 'support@', otherwise name is impossible to get.
        $first_part = explode( '@', $email )[0];
        $usable_email = ($first_part == 'contact' || $first_part == 'support');

        //If true:
        if($usable_email):
            //full_name = email, after @, before '.'
            $full_name = explode( '.', explode( '@', $email )[1] )[0];
            
            //Check for instance if already exists
            if (!(Supplier::where('email', '=', $email)->exists())):
                //If not exists, create new instance (full_name, email) + return id of instance to product
                //create new instance of supplier
                $supplier = new Supplier([
                    'full_name' => $full_name,
                    'email' => $email
                ]);
                //add supplier to DB
                $supplier->save();
                return (Supplier::where('email', '=', $email)->first()->id);
            endif;
            //If exists, return id of existing email
            return (Supplier::where('email', '=', $email)->first()->id);
        endif;
        
        //If false, return id of empty email (full_name = unknown, email = unknown)
        return(1);
    }
}
