<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Film;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('actors.index', [
            'actors' => Actor::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('actors.form');
    }

    protected function formData(){
        return request()->validate([
            'name' => 'required|unique',
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->formData();
        $data = Actor::on()->create($data);
        return redirect()->route('actors.show', $data);
    }

    public function show(Actor $actor)
    {
        $films = $actor->films;

        $films = $films->map(function (Film $film){
            return $film;
        });

        $films = $films->toArray();


        return view('actors.show', [
            'films' => $films,
            'actor' => $actor
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function edit(Actor $actor)
    {
        return view('actors.form', compact('actor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actor $actor)
    {
        $data = $this->validated($request, $actor);

        $actor->update($data);
        return redirect()->route('actors.show', $actor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actor $actor)
    {
        $actor->delete();
        return redirect()->route('actors.index');
    }

    protected function validated(Request $request, Actor $actor = null){
        $rules = [
            'fio' => 'required'
        ];


        return $request->validate($rules);
    }
}
