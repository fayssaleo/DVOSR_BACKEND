<?php

namespace App\Modules\Crane\Models;

use App\Modules\Voyage\Models\CraneVoyage;
use Illuminate\Database\Eloquent\Model;

class Crane extends Model
{
    protected $guarded=["id"];
    public function craneVoyages()
    {
        return $this->hasMany(CraneVoyage::class);
    }
}
