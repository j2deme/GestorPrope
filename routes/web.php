<?php

use App\Http\Controllers\AspiranteController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Aspirante;
use App\Models\Horario;
use App\Models\Grupo;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/cotejo-ficha', function (Request $request) {
    # Validar que los campos de ficha y CURP estén presentes y no estén vacíos
    if ($request->filled(['ficha', 'curp'])) {
        # Buscar al aspirante por ficha y CURP
        $aspirante = Aspirante::where('ficha', trim($request->ficha))
            ->where('curp', trim($request->curp))
            ->first();

        if ($aspirante) {
            # Si el aspirante no ha sido evaluado, no puede acceder a la selección de grupo
            if (!$aspirante->evaluado) {
                return redirect()->back()->with('danger', 'Aún no has sido evaluado, no puedes acceder a la selección de grupo.');
            }

            # Revisar si la fecha de selección del aspirante es hoy
            if (is_null($aspirante->fecha_acceso) || $aspirante->fecha_acceso->greaterThanOrEqualTo(now())) {
                return redirect()->back()->with('danger', 'Aún no puedes acceder a la selección de grupo, revisa tu fecha de acceso.');
            }

            # Revisar si el aspirante ya seleccionó grupo y redirigir a la página correspondiente
            if ($aspirante->fecha_seleccion) {
                return redirect()->route('cotejo-ficha', ['ficha' => $aspirante->ficha]);
            } else {
                return view('confirmar-aspirante', compact('aspirante'));
            }
        }

        # Si no se encontró al aspirante, redirigir con un mensaje de error
        return redirect()->back()->with('danger', 'Ficha no encontrada, revisa los datos ingresados.');
    }

    return redirect()->back()->with('danger', 'Favor de llenar todos los campos');
})->name('cotejo-ficha-post');

Route::get('/cotejo-ficha', fn() => redirect()->route('home'));

Route::get('/cotejo-ficha/{ficha}', function (string $ficha) {
    $aspirante = Aspirante::where('ficha', $ficha)->first();
    $grupo     = $aspirante->grupo;
    return view('cotejo-ficha', compact('aspirante', 'grupo'));
})->name('cotejo-ficha');

Route::get('/seleccion-grupo/{ficha}', function (string $ficha) {
    $aspirante = Aspirante::where('ficha', $ficha)->first();
    $horarios  = Horario::where('periodo', date('Y'))->orderBy('hora_inicio')->get();
    dd($horarios);


    return view('seleccion-grupo', compact('aspirante'));
})->name('seleccion-grupo');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('aspirantes', AspiranteController::class);
Route::resource('horarios', HorarioController::class);
Route::resource('grupos', GrupoController::class);

require __DIR__ . '/auth.php';
