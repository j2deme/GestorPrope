<?php

namespace App\Http\Controllers;

use App\Models\Aspirante;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AspiranteRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AspiranteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $aspirantes = Aspirante::paginate();

        return view('aspirante.index', compact('aspirantes'))
            ->with('i', ($request->input('page', 1) - 1) * $aspirantes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $aspirante = new Aspirante();

        return view('aspirante.create', compact('aspirante'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AspiranteRequest $request): RedirectResponse
    {
        Aspirante::create($request->validated());

        return Redirect::route('aspirantes.index')
            ->with('success', 'Aspirante created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $aspirante = Aspirante::find($id);

        return view('aspirante.show', compact('aspirante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $aspirante = Aspirante::find($id);

        return view('aspirante.edit', compact('aspirante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AspiranteRequest $request, Aspirante $aspirante): RedirectResponse
    {
        $aspirante->update($request->validated());

        return Redirect::route('aspirantes.index')
            ->with('success', 'Aspirante updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Aspirante::find($id)->delete();

        return Redirect::route('aspirantes.index')
            ->with('success', 'Aspirante deleted successfully');
    }
}
