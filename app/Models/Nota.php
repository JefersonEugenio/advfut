<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = ['equipe_id', 'equipe_avaliacao', 'avaliacao_nota'];

    public function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }
}
