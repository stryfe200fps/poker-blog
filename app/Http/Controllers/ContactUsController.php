<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\ContactForm;

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

        return response()->json(['status' => 200]);
    }

    //
}
