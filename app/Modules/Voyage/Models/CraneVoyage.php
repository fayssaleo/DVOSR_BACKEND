<?php

namespace App\Modules\Voyage\Models;

use App\Modules\Crane\Models\Crane;
use Illuminate\Database\Eloquent\Model;

class CraneVoyage extends Model
{
    protected $table="crane_voyages";
    protected $guarded=["id"];
    public function voyage()
    {
        return $this->belongsTo(Voyage::class);
    }
    public function crane()
    {
        return $this->belongsTo(Crane::class);
    }
    protected $casts = [
        'cbd' => 'datetime:d/m/Y H:i',
        'dgbohc_bfl_from' => 'datetime:d/m/Y H:i',
        'dgbohc_bfl_to' => 'datetime:d/m/Y H:i',
        'dss_bfl_from' => 'datetime:d/m/Y H:i',
        'dss_bfl_to' => 'datetime:d/m/Y H:i',
        'ffl' => 'datetime:d/m/Y H:i',
        'fll' => 'datetime:d/m/Y H:i',
        'sfl' => 'datetime:d/m/Y H:i',
        'sll' => 'datetime:d/m/Y H:i',
        'tfl' => 'datetime:d/m/Y H:i',
        'tll' => 'datetime:d/m/Y H:i',
        'lgbohc_all_from' => 'datetime:d/m/Y H:i',
        'lgbohc_all_to' => 'datetime:d/m/Y H:i',
        'lss_all_from' => 'datetime:d/m/Y H:i',
        'lss_all_to' => 'datetime:d/m/Y H:i',
        'cbu' => 'datetime:d/m/Y H:i',
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
    ];
}
