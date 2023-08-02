<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone_fixe',
        'service',
        'fonction',
        'cle',
        'deleted_at',
        'organisation_id',
    ];
    public function organisation(): BelongsTo {
        return $this->belongsTo(\App\Models\Organisation::class);
    }
}
