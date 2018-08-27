<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamProcess extends Model
{
    protected $table = "teams_process";
    
    public function Team() {
        return $this->belongsTo('App\Models\User', 'team_id', 'id');
    }

    public function Station() {
        return $this->belongsTo('App\Models\User', 'station_id', 'id');
    }
}
