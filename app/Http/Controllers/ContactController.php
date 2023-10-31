<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class ContactController extends Controller
{
    public function index()
    {
        return view('contacts.index');
    }

    public function create()
    {
        return Redirect::to(URL::route('contacts.index', ['#create']));
    }

    public function edit()
    {
        return Redirect::to(URL::route('contacts.index', ['#edit']));
    }
}
