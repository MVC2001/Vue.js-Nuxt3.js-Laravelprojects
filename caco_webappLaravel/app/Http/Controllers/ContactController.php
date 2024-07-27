<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{


    public function index()
    {
        $contacts = Contact::all();

        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contact');
    }

  public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'subject' => 'required',
        'message' => 'required',
    ]);

    Contact::create($request->all());

    return redirect()->route('contact')->with('success', 'Message sent successfully!');
}

}
