<?php

namespace App\Http\Controllers;

use App\Models\Aspirante;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AspiranteRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class AspiranteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $ficha    = $request->input('ficha');
        $query    = Aspirante::query();
        $filtrado = false;

        if ($ficha) {
            $query->where('ficha', $ficha);
            $filtrado = true;
        }

        $fecha_seleccionada = $request->input('fecha_acceso');
        if ($fecha_seleccionada) {
            $query->where('fecha_acceso', $fecha_seleccionada);
            $filtrado = true;
        }

        $aspirantes = $query->orderBy('fecha_acceso')
            ->orderBy('nombre');

        $fechas_acceso = $aspirantes->pluck('fecha_acceso')->unique()->sort()->values();
        $aspirantes    = $query->paginate();


        return view('aspirante.index', compact('aspirantes', 'filtrado', 'ficha', 'fechas_acceso', 'fecha_seleccionada'))
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
            ->with('success', 'Aspirante registrado exitosamente.');
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
            ->with('success', 'Aspirante actualizado exitosamente.');
    }

    public function destroy($id): RedirectResponse
    {
        Aspirante::find($id)->delete();

        return Redirect::route('aspirantes.index')
            ->with('success', 'Aspirante eliminado exitosamente.');
    }

    public function uploadForm(): View
    {
        return view('aspirante.upload');
    }

    public function upload(Request $request): RedirectResponse
    {
        $request->validate([
            'fecha' => 'required|date',
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $path = $file->storeAs('aspirantes', $file->getClientOriginalName());

        $csv = array_map('str_getcsv', file(storage_path("app/$path")));

        foreach ($csv as $row) {
            # Skip the header row
            $header = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row[0]);
            if (Str::lower($header) === 'ficha' || $header === '') {
                continue;
            }

            # Find or create aspirante
            $aspirante = Aspirante::firstOrNew([
                'ficha' => $row[0],
            ]);

            $aspirante->nombre           = $row[1];
            $aspirante->curp             = $row[2];
            $aspirante->carrera          = $row[3];
            $aspirante->evaluado         = ($row[4] == 'SI');
            $aspirante->puntaje          = $row[5] * 100;
            $aspirante->fecha_evaluacion = null;
            $aspirante->fecha_acceso     = $request->fecha;
            $aspirante->periodo          = date('Y');

            $aspirante->save();
        }

        return Redirect::route('aspirantes.index')
            ->with('success', 'Aspirantes subidos exitosamente.');
    }

    public function download(): Response
    {
        # Increase the memory limit to avoid memory exhausted errors
        ini_set('memory_limit', '512M');
        # Increase the maximum execution time to avoid timeout errors
        ini_set('max_execution_time', 300);

        $aspirantes = Aspirante::where('periodo', date('Y'))->orderBy('fecha_acceso')->get();

        $csv = fopen('php://temp', 'r+');
        fputcsv($csv, ['Ficha', 'Nombre', 'CURP', 'Carrera', 'Fecha de acceso', 'Fecha de seleccion', 'Grupo']);

        foreach ($aspirantes as $aspirante) {
            fputcsv($csv, [
                $aspirante->ficha,
                $aspirante->nombre,
                $aspirante->curp,
                $aspirante->carrera,
                $aspirante->fecha_acceso,
                $aspirante->fecha_seleccion,
                optional($aspirante->grupo)->nombre,
            ]);
        }

        rewind($csv);
        $csv = stream_get_contents($csv);

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Encoding', 'UTF-8')
            ->header('Content-Disposition', 'attachment; filename="aspirantes-' . date('Y') . '.csv"');
    }
}
