<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\StoreContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(StoreContactRequest $request)
    {
        Contact::create($request->all());
        session()->flash('status', 'Thanks for sent contact!');
        return back();
    }
}
