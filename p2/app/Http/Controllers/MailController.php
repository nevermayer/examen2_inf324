<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;

class MailController extends Controller
{

    
    public function index(Request $request)
    {
        
       $mailData = [
         'nombre'=>$request->nombre,
          'email' => $request->email,
          'mensaje'  => $request->mensaje,
       ];
    Mail::to('pruebacontrolador@gmail.com')->send(new DemoMail($mailData));
    }  
}
