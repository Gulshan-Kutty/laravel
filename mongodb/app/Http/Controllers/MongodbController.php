<?php

namespace App\Http\Controllers;

use App\Models\Mongodb;
use Illuminate\Http\Request;
use MongoDB\Operation\Update;

class Mongodbcontroller extends Controller
{
    public function index()
    {
        $user = Mongodb::all();
        return view('mongodb.index', compact('user'));
    }

    public function create()
    {
        return view('mongodb.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        Mongodb::create($request->all());
        return redirect()->route('mongodb.index')->withSuccess('User Added Successfully...!');
    }


    public function show($id)
    {
        $user = Mongodb::findorFail($id);
        return view('mongodb.show', compact('user'));
    }

    public function edit($id)
    {
        $user = Mongodb::findorFail($id);
        return view('mongodb.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = Mongodb::findorFail($id);
        $user->update($request->all());

        return redirect()->route('mongodb.index')
            ->withSuccess('Product is updated successfully.');
    }


    public function destroy($id)
    {
        $user = Mongodb::findorFail($id);
        $user->delete();
        return redirect()->route('mongodb.index')->withSuccess('Product is deleted successfully.');
    }
}
