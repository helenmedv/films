<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Film;
use App\Genre;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('films.index', [
            'films' => Film::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('create', Film::class);
        return view('films.form', [
            'genres' => Genre::all(),
            'actors' => Actor::all(),
            'filmGenres' => [],
            'filmActors' => [],
        ]);
    }

    protected function formData(){
        return request()->validate([
            'title' => 'required',
            'image' => 'nullable|file',
            'genres' => 'nullable|array',
            'actors' => 'nullable|array'
        ]);
    }

    public function store(Request $request)
    {
        //$this->authorize('create', Film::class);


        //$data = $this->validated($request);
        $data = $this->formData();

        if($data['image'] ?? false){
            /** @var  UploadedFile $file */
            $file = $data['image'];
            $file->storeAs('public/images', $name = Str::random() . '.' . $file->extension());
            $data['image'] = "images/$name";
        }


        //$films = auth()->user()->films();
        $data = collect($data);
        $new = Film::on()->create($data->except('genres', 'actors')->toArray());

        foreach ($data->get('genres') as $id){
            /** @var Genre $genre */
            $genre = Genre::on()->find($id);
            $genre->film()->save($new);
        }

        foreach ($data->get('actors') as $id){
            /** @var Actor $actor */
            $actor = Actor::on()->find($id);
            $actor->film()->save($new);
        }

        return redirect()->route('films.show', $new);
    }

    public function show(Film $film, Genre $genre = null)
    {
        var_dump($genre);
        //$this->authorize('view', $film);
        if ($film->genres()->find($genre))
        return null;
            else
        return view('films.show', compact('film'));
    }

    public function edit(Film $film)
    {
        //$this->authorize('update', $film);
        $filmGenres = $film->genres;
        $filmGenres = $filmGenres->map(function (Genre $genre){
            return $genre->id;
        });

        $filmActors = $film->actors;
        $filmActors = $filmActors->map(function (Actor $actor){
            return $actor->id;
        });

        return view('films.form', [
            'film' => $film,
            'image' => $film->image,
            'year' => $film->year,
            'filmGenres' => $filmGenres->toArray(),
            'genres' => Genre::all(),
            'filmActors' => $filmActors->toArray(),
            'actors' => Actor::all()
        ]);
    }


    public function update(Request $request, Film $film)
    {
  //      $this->authorize('update', $film);
        //$data = $this->validated($request, $film);

        $data = $this->formData();
        $data = collect($data);

        if($data['image'] ?? false){
            /** @var  UploadedFile $file */
            $file = $data['image'];
            $file->storeAs('public/images', $name = Str::random() . '.' . $file->extension());
            $data['image'] = "images/$name";
        }

        foreach ($data->get('genres') as $id){
            /** @var Genre $genre */
            $genre = Genre::on()->find($id);
            $genre->films()->save($film);
        }

        foreach ($data->get('actors') as $id){
            /** @var Actor $actor */
            $actor = Actor::on()->find($id);
            $actor->films()->save($film);
        }

        $film->update($data->except('genres', 'actors')->toArray());
        return redirect()->route('films.show', $film);
    }

    public function destroy(Film $film)
    {
        $this->authorize('delete', $film);

        $film->delete();
        return redirect()->route('films.index');
    }

    protected function validated(Request $request, Film $film = null){
        $rules = [
            'title' => 'required',
            'image' => 'nullable|file',
            'genres' => 'nullable|array',
            'actors' => 'nullable|array'
        ];


        return $request->validate($rules);
    }
}
