<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Horario
 *
 * @property $id
 * @property $hora_inicio
 * @property $hora_fin
 * @property $descripcion
 * @property $periodo
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Horario extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['hora_inicio', 'hora_fin', 'descripcion', 'periodo'];

    public function grupos()
    {
        return $this->hasMany(\App\Models\Grupo::class, 'horario_id', 'id');
    }


}