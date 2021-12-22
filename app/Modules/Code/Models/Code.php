<?php

namespace App\Modules\Code\Models;

use App\Modules\Voyage\Models\OtherDelay;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;
    protected $guarded=["id"];
    public function otherDelays()
    {
        return $this->hasMany(OtherDelay::class);
    }
}
