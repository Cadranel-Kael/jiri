<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return view('events.index');
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        $heading = auth()->user()->events()->where('id', $id)->first()->name;

        return view('events.show', compact('heading', 'id'));
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
