<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Horario;
use App\Models\Aspirante;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\GrupoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $grupos = Grupo::paginate();

        return view('grupo.index', compact('grupos'))
            ->with('i', ($request->input('page', 1) - 1) * $grupos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $grupo    = new Grupo();
        $horarios = Horario::where('periodo', date('Y'))->orderBy('hora_inicio')->get();

        return view('grupo.create', compact('grupo', 'horarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GrupoRequest $request): RedirectResponse
    {
        Grupo::create($request->validated());

        return Redirect::route('grupos.index')
            ->with('success', 'Grupo registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $grupo      = Grupo::find($id);
        $aspirantes = Aspirante::where('grupo_id', $grupo->id)->orderBy('nombre')->get();

        return view('grupo.show', compact('grupo', 'aspirantes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $grupo    = Grupo::find($id);
        $horarios = Horario::where('periodo', date('Y'))->orderBy('hora_inicio')->get();

        return view('grupo.edit', compact('grupo', 'horarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GrupoRequest $request, Grupo $grupo): RedirectResponse
    {
        $grupo->update($request->validated());

        return Redirect::route('grupos.index')
            ->with('success', 'Grupo actualizado exitosamente.');
    }

    public function destroy($id): RedirectResponse
    {
        Grupo::find($id)->delete();

        return Redirect::route('grupos.index')
            ->with('success', 'Grupo eliminado exitosamente.');
    }

    public function remove(Grupo $grupo, Aspirante $aspirante): RedirectResponse
    {
        $grupo->inscritos--;
        $grupo->save();

        $aspirante->grupo()->dissociate();
        $aspirante->fecha_seleccion = null;
        $aspirante->save();

        return Redirect::route('grupos.show', $grupo->id)
            ->with('success', 'Aspirante eliminado del grupo exitosamente.');
    }
}
