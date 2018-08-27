<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    public static function getUserList($id = [], $name = '', $type = 3, $order = 'asc') {
        $userList = self::orderBy('id', 'asc');

        if(is_array($id) && !empty($id)) {
            $userList = $userList->whereIn('id', $id);
        }

        if(!empty($name)) {
            $userList = $userList->where('name', 'LIKE', $name);
        }

        if(is_numeric($type) && $type != 3) {
            $userList = $userList->where('role_id', $type);
        }

        $userList = $userList->orderBy('id', $order)->get();

        return $userList;
    }

    public function Suggestions() {
        return $this->hasMany('App\Models\Suggestion', 'station_id', 'id');
    }

    public function getMarks() {
        return $this->hasMany('App\Models\TeamMark', 'team_id', 'id');
    }
}
