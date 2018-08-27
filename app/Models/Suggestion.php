<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $table = "suggestions";

    public function Station() {
        return $this->belongsTo('App\Models\User', 'station_id', 'id');
    }
}
