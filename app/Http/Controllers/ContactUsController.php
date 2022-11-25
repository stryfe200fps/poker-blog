<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactMail;
use App\Models\ContactForm;
use Backpack\Settings\app\Models\Setting;
use Exception;
use Illuminate\Support\Facades\Mail; // Put this at the top of your controller

class ContactUsController extends Controller
{
    public function store(ContactFormRequest $request)
    {

        $form = ContactForm::make([
            'name' => $request->get('name'),
            'subject' => $request->get('subject'),
            'message' => $request->get('message'),
            'email' => $request->get('email'),
        ]);

<<<<<<< HEAD
        $email = env('ADMIN_EMAIL', Setting::get('admin_email') ?? 'adi@yahoo.com' );
=======
        $email = env('ADMIN_EMAIL', Setting::get('contact_email') ?? 'adi@yahoo.com' );
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
        Mail::to($email)->send(new ContactMail($form));

        return response()->json(['status' => 200]);
    }

    //
}
