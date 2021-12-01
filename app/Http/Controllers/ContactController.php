<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Notifications\NewContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        return view("contact");
    }

    public function form(Request $request)
    {
        #ddd($request);

        #salva o contato
        $contact = Contact::create($request->all());

        #envia o e-mail
        Notification::route("mail", config("mail.from.address"))
                        ->notify(new NewContact($contact));

        #volta para a tela do formulário
        return redirect()->back();
    }
}
