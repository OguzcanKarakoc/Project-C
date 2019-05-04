<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;


class ContactController extends Controller
{
    public function index()
    {
        return view('page.front-end.contact.index');
    }

    public function sendEmail(Request $request)
    {
        $comment = Request::input('message');
        $name = Request::input('name');
        $mail = Request::input('email');

        $data = array('username' => $name, 'email' => $mail, 'comment' => $comment);

        //Mail user
        Mail::send('emails.mailcontact', $data, function ($message) {
            $mail = Request::input('email');
            $message->from('gameshop.noreply@gmail.com', 'GameShop HR Department');
            $message->subject('Contact Form');
            $message->to($mail);
        });


        //Admin Notification
        Mail::send('emails.mailcontactAdmin',$data, function ($message) {

            $message->from('gameshop.noreply@gmail.com', 'GameShop HR Department');
            $message->subject('Contact Form');
            $message->to('admin.mp@gmail.com');
        });

        Session::flash('message1', 'Your message has been sent!');
        return redirect()->back();
    }
}