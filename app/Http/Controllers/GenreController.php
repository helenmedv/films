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
            'name' => 'required|unique:genres',
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->formData();
        $data = Genre::on()->create($data);
        return redirect()->route('genres.show', $data);
    }

    public function show(Genre $genre)
    {

        $films = $genre->films;

        $films = $films->map(function (Film $film){
            return $film;
        });

        $films = $films->toArray();


        return view('genres.show', [
            'films' => $films,
            'genre' => $genre
        ]);
    }

    public function edit(Genre $genre)
    {
        return view('genres.form', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $data = $this->validated($request, $genre);

        $genre->update($data);
        return redirect()->route('genres.show', $genre);
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('genres.index');
    }

    protected function validated(Request $request, Genre $genre = null){
        $rules = [
            'name' => 'required|unique:genres'
        ];


        return $request->validate($rules);
    }
}
