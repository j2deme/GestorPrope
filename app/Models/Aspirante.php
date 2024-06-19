<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Aspirante
 *
 * @property $id
 * @property $ficha
 * @property $nombre
 * @property $curp
 * @property $carrera
 * @property $evaluado
 * @property $puntaje
 * @property $fecha_evaluacion
 * @property $fecha_seleccion
 * @property $periodo
 * @property $fecha_acceso
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Aspirante extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['ficha', 'nombre', 'curp', 'carrera', 'evaluado', 'puntaje', 'fecha_evaluacion', 'fecha_seleccion', 'periodo', 'fecha_acceso', 'grupo_id'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'evaluado' => 'boolean',
        'fecha_evaluacion' => 'datetime',
        'fecha_seleccion' => 'datetime',
        'fecha_acceso' => 'date',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grupo()
    {
        return $this->belongsTo(\App\Models\Grupo::class, 'grupo_id', 'id');
    }


}
