<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMark extends Model
{
    protected $table = 'team_marks';

    public function Mark_Criteria() {
        return $this->belongsTo('App\Models\MarkCriteria', 'criteria_id');
    }

    public function Station() {
        return $this->belongsTo('App\Models\User', 'station_id', 'id');
    }
}
