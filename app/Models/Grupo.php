<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Grupo
 *
 * @property $id
 * @property $nombre
 * @property $cupo
 * @property $inscritos
 * @property $aula
 * @property $activo
 * @property $periodo
 * @property $horario_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Horario $horario
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Grupo extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre', 'cupo', 'inscritos', 'aula', 'activo', 'periodo', 'horario_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<int, string>
     */
    protected $casts = [
        'activo' => 'boolean',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function horario()
    {
        return $this->belongsTo(\App\Models\Horario::class, 'horario_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aspirantes()
    {
        return $this->hasMany(\App\Models\Aspirante::class, 'grupo_id', 'id');
    }

}
