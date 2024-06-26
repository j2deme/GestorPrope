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

/*Route::get('/seleccion-grupo/{ficha}', function (string $ficha) {
    $aspirante = Aspirante::where('ficha', $ficha)->first();
    $horarios  = Horario::with('grupos')->where('periodo', date('Y'))->orderBy('hora_inicio')->get();

    # Get the first group that has available space for every horario if any
    $turnos = $horarios->map(function ($horario) {
        return $horario->grupos->first(fn($grupo) => $grupo->cupo > $grupo->inscritos);
    });

    # Remove null values from the collection
    $turnos = $turnos->filter();

    return view('seleccion-grupo', compact('aspirante', 'turnos'));
})->name('seleccion-grupo');*/

Route::get('/seleccion-turno/{ficha}', function (string $ficha) {
    $aspirante = Aspirante::where('ficha', $ficha)->first();
    $horarios  = Horario::with('grupos')->where('periodo', date('Y'))->orderBy('hora_inicio')->get();

    # Get the first group that has available space for every horario if any
    $turnos = $horarios->map(function ($horario) {
        return $horario->availableGroups()->first();
    });

    # Remove null values from the collection
    $turnos = $turnos->filter();

    return view('seleccion-grupo', compact('aspirante', 'turnos'));
})->name('seleccion-turno');

Route::get('/confirmar-turno/{ficha}/{horario}', function (string $ficha, Horario $horario) {
    $aspirante = Aspirante::where('ficha', $ficha)->first();

    if ($aspirante->grupo) {
        //session()->flash('warning', 'Ya has seleccionado un grupo, no puedes seleccionar otro.');
        $grupo     = $aspirante->grupo;
        $confirmar = false;
    } else {
        # Get the first group that has available space for the selected horario
        $grupo = $horario->availableGroups()->first();

        $aspirante->grupo()->associate($grupo);
        $confirmar = $aspirante->save();

        if (!$confirmar) {
            session()->flash('danger', 'Ocurrió un error inesperado, intenta de nuevo.');
            return redirect()->route('seleccion-grupo', ['ficha' => $aspirante->ficha]);
        } else {
            # Update the number of inscritos in the group, and if the group is full, update the status
            $grupo->inscritos++;
            if ($grupo->cupo === $grupo->inscritos) {
                $grupo->activo = false;
            }
            $grupo->save();
        }

        # Update the aspirante's fecha_seleccion if the group was successfully assigned
        $aspirante->fecha_seleccion = now();
        $aspirante->save();

        session()->now('success', "$aspirante->nombre ha sido registrado en el grupo $grupo->nombre exitosamente.");
    }

    return view('cotejo-ficha', compact('aspirante', 'grupo', 'confirmar'));
})->name('confirmar-turno');

Route::get('/revisar-turno/{ficha}', function (string $ficha) {
    $aspirante = Aspirante::where('ficha', $ficha)->first();
    $grupo     = $aspirante->grupo;
    return view('cotejo-ficha', compact('aspirante', 'grupo'));
})->name('revisar-turno');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('aspirantes', AspiranteController::class);
    Route::get('/aspirantes-upload', [AspiranteController::class, 'uploadForm'])->name('aspirantes.upload');
    Route::post('/aspirantes-upload', [AspiranteController::class, 'upload'])->name('aspirantes.upload.post');
    Route::get('/aspirantes-download', [AspiranteController::class, 'download'])->name('aspirantes.download');
    Route::resource('horarios', HorarioController::class);
    Route::resource('grupos', GrupoController::class);
    Route::delete('/grupos/{grupo}/remove/{aspirante}', [GrupoController::class, 'remove'])->name('grupos.remove');
});

require __DIR__ . '/auth.php';
