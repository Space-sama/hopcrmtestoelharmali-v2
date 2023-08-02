<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Organisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'adresse',
        'code_postal',
        'ville',
        'cle',
        'statut',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function Contact(): HasOne {
        return $this->hasOne(\App\Models\Contact::class);
    }
}
