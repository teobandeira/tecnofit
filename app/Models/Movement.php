<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relacionamento: Um movimento pode ter vários recordes pessoais
    public function personalRecords()
    {
        return $this->hasMany(PersonalRecord::class);
    }
}
