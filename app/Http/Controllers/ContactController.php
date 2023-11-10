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

    public function show($id)
    {
        $heading = auth()->user()->contacts()->where('id', $id)->first()->name;

        return view('contacts.show', compact('heading', 'id'));
    }
}
