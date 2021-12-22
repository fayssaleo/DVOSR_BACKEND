<?php

namespace App\Modules\Voyage\Models;

use App\Modules\Utilisateur\Models\Utilisateur;
use App\Modules\Vessel\Models\Vessel;
use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    protected $guarded=["id"];
    public function vessel()
    {
        return $this->belongsTo(Vessel::class);
    }
    public function craneVoyages()
    {
        return $this->hasMany(CraneVoyage::class);
    }
    public function crane_voyages()
    {
        return $this->hasMany(CraneVoyage::class);
    }
    public function utilisateurs(){
        return $this->hasMany(Utilisateur::class);
    }

    public function otherDelays(){
        return $this->hasMany(OtherDelay::class);
    }
    public function other_delays(){
        return $this->hasMany(OtherDelay::class);
    }
    protected $casts = [
        'first_line_datetime' => 'datetime:d/m/Y H:i',
        'vessel_all_fast' => 'datetime:d/m/Y H:i',
        'gangway_secured' => 'datetime:d/m/Y H:i',
        'lashers_onboard' => 'datetime:d/m/Y H:i',
        'last_lift_from' => 'datetime:d/m/Y H:i',
        'last_lift_to' => 'datetime:d/m/Y H:i',
        'lf_from' => 'datetime:d/m/Y H:i',
        'lf_to' => 'datetime:d/m/Y H:i',
        'agent_onboard_from' => 'datetime:d/m/Y H:i',
        'agent_onboard_to' => 'datetime:d/m/Y H:i',
        'safety_net_gangway_from' => 'datetime:d/m/Y H:i',
        'safety_net_gangway_to' => 'datetime:d/m/Y H:i',
        'pilot_onboard_from' => 'datetime:d/m/Y H:i',
        'pilot_onboard_to' => 'datetime:d/m/Y H:i',
        'tugs_arrived_from' => 'datetime:d/m/Y H:i',
        'tugs_arrived_to' => 'datetime:d/m/Y H:i',

        'unmooring_forward_from' => 'datetime:d/m/Y H:i',
        'unmooring_forward_to' => 'datetime:d/m/Y H:i',
        'unmooring_aft_from' => 'datetime:d/m/Y H:i',
        'unmooring_aft_to' => 'datetime:d/m/Y H:i',
        'last_line_from' => 'datetime:d/m/Y H:i',
        'last_line_to' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
        'created_at' => 'datetime:d/m/Y H:i',
    ];

}
