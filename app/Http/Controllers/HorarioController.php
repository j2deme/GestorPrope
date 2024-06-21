<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\HorarioRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $horarios = Horario::orderBy('hora_inicio')->paginate();

        return view('horario.index', compact('horarios'))
            ->with('i', ($request->input('page', 1) - 1) * $horarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $horario = new Horario();

        return view('horario.create', compact('horario'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HorarioRequest $request): RedirectResponse
    {
        Horario::create($request->validated());

        return Redirect::route('horarios.index')
            ->with('success', 'Horario registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $horario = Horario::find($id);

        return view('horario.show', compact('horario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $horario = Horario::find($id);

        return view('horario.edit', compact('horario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HorarioRequest $request, Horario $horario): RedirectResponse
    {
        $horario->update($request->validated());

        return Redirect::route('horarios.index')
            ->with('success', 'Horario actualizado exitosamente.');
    }

    public function destroy($id): RedirectResponse
    {
        Horario::find($id)->delete();

        return Redirect::route('horarios.index')
            ->with('success', 'Horario eliminado exitosamente.');
    }
}
