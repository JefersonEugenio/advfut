<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'data', 
        'hora', 
        'duracao',
        'tipo',
        'endereco',
        'bairro',
        'cidade',
        'pagamento',
        'observacao',
        'equipe_me',
        'equipe_adversario'
    ];

    public function equipeMe() {
        return $this->belongsTo(Equipe::class, 'equipe_me');
    }

    public function equipeAdversario() {
        return $this->belongsTo(Equipe::class, 'equipe_adversario');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function equipe() {
        return $this->belongsTo(Equipe::class);
    }

    public function equipesParticipantes() {
        return $this->belongsToMany(Equipe::class, 'agenda_equipe', 'agenda_id', 'equipe_id');
    }

    // Define the relationship with User via the pivot table 'agenda_user'
    public function users() {
        return $this->belongsToMany(User::class, 'agenda_user');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($agenda) {
            // Excluir os registros relacionados na tabela de pivot 'agenda_user'
            $agenda->users()->detach();
        });
    }
}