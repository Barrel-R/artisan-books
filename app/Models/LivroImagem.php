<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LivroImagem extends Model
{
    use HasFactory;

    protected $fillable = ["livro_id", "path"];

    protected $table = "imagens";

    public function livro(): BelongsTo
    {
        return $this->belongsTo(Livro::class);
    }
}
