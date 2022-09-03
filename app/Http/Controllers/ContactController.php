<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
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

    public function form(ContactRequest $request)
    {

        $validated = $request->validated();
        #ddd($request);
        /*$validated = $request->validate([
            'name' => 'required|max:250',
            'email' => 'required|max:250|email',
            'phone' => 'integer',
            'subject' => 'required|max:250',
            'message' => 'required|max:8000'
        ]);*/

        #salva o contato
        $contact = Contact::create($request->all());

        #envia o e-mail
        Notification::route("mail", config("mail.from.address"))
                        ->notify(new NewContact($contact));

        #volta para a tela do formulário
        return redirect()->back()->with('success', 'Your message was sent');  
    }
}
