<?php

namespace App\Http\Controllers;

use App\Film;
use App\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{

    public function index()
    {
        return view('genres.index', [
            'genres' => Genre::all()
        ]);
    }


    public function create()
    {
        return view('genres.form');
    }

    protected function formData(){
        return request()->validate([
            'name' => 'required|unique',

        ]);
    }

    public function store(Request $request)
    {
        $data = $this->formData();
        $data->create($data);
        return redirect()->route('genres.show', $data);
    }

    public function show(Genre $genre)
    {
        //
    }

    public function edit(Genre $genre)
    {
        //
    }

    public function update(Request $request, Genre $genre)
    {
        //
    }

    public function destroy(Genre $genre)
    {
        //
    }

    protected function validated(Request $request, Genre $genre = null){
        $rules = [
            'name' => 'required|unique'
        ];


        return $request->validate($rules);
    }
}
