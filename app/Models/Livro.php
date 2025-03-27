<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livro extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "titulo",
        "descricao",
        "descricaoLonga",
        "genero",
    ];

    public function imagens(): HasMany
    {
        return $this->hasMany(LivroImagem::class);
    }

    public function videos(): HasMany
    {
        return $this->hasMany(LivroVideo::class);
    }

    public function categorias(): BelongsToMany
    {
        return $this->belongsToMany(Categoria::class);
    }
}
