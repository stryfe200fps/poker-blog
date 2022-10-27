<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactMail;
use App\Models\ContactForm;
use Illuminate\Support\Facades\Mail; // Put this at the top of your controller

class ContactUsController extends Controller
{
    public function store(ContactFormRequest $request)
    {
        $form = ContactForm::create([
            'name' => $request->get('name'),
            'subject' => $request->get('subject'),
            'message' => $request->get('message'),
            'email' => $request->get('email'),
        ]);

        Mail::to('adichan@yahoo.com')->send(new ContactMail($form));

        return response()->json(['status' => 200]);
    }

    //
}
