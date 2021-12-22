<?php

namespace App\Modules\Vessel\Models;

use App\Modules\Utilisateur\Models\Action;
use App\Modules\Voyage\Models\Voyage;
use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{
    protected $guarded=["id"];
    public function voyages()
    {
        return $this->hasMany(Voyage::class);
    }
    public function actions(){
        return $this->hasMany(Action::class)->with("utilisateur")->get();
    }
    protected $casts = [
        'eta' => 'datetime:d/m/Y H:i',
        'etd' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
        'created_at' => 'datetime:d/m/Y H:i',

    ];
}
