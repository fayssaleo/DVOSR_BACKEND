<?php

namespace App\Modules\Utilisateur\Models;

use App\Modules\Vessel\Models\Vessel;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }
    public function voyage()
    {
        return $this->belongsTo(Vessel::class);
    }
    protected $casts = [

        'created_at' => 'datetime:d/m/Y H:00',

    ];
}
