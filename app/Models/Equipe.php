<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    use HasFactory;

    protected $fillable = ['clube', 'imagem', 'user_id', 'agenda_id'];

    public function agendasComoEquipeMe()
    {
        return $this->hasMany(Agenda::class, 'equipe_me');
    }

    public function agendas()
    {
        return $this->hasMany(Agenda::class, 'equipe_me');
    }

    public function agendasComoEquipeAdversario()
    {
        return $this->hasMany(Agenda::class, 'equipe_adversario');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function agenda() {
        return $this->belongsTo(Agenda::class, 'agenda_id');
    }

    public function users() {
        return $this->belongsToMany('App\Models\User', 'equipe_user');
    }

}