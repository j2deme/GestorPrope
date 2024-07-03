<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    public function display(): Attribute
    {
        return new Attribute(
            get: fn($value) => sprintf("%02d - %02d", $this->hora_inicio, $this->hora_fin),
        );
    }

    public function grupos()
    {
        return $this->hasMany(\App\Models\Grupo::class, 'horario_id', 'id');
    }

    public function aspirantes()
    {
        return $this->hasManyThrough(\App\Models\Aspirante::class, \App\Models\Grupo::class, 'horario_id', 'grupo_id', 'id', 'id');
    }

    public function availableGroups()
    {
        return $this->hasMany(\App\Models\Grupo::class, 'horario_id', 'id')
            ->whereColumn('cupo', '>', 'inscritos')
            ->orderBy('inscritos', 'asc');
    }

    # Virtual attribute "dias" as an alias for "descripcion"
    public function dias(): Attribute
    {
        return new Attribute(
            get: fn($value) => str_replace('-', ' - ', str_replace(' ', '', $this->descripcion)),
        );
    }

    public function descripcion(): Attribute
    {
        return new Attribute(
            set: fn($value) => trim($value),
        );
    }

}
