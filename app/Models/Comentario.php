<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = ['equipe_id', 'equipe_avaliacao', 'avaliacao_comentario'];

    public function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }
}
