<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalRecord extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'movement_id', 'value', 'date'];

    // Relacionamento: Um recorde pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento: Um recorde pertence a um movimento
    public function movement()
    {
        return $this->belongsTo(Movement::class);
    }
}