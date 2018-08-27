<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\MarkCriteria;
use App\Models\TeamMark;

class AdminController extends Controller
{
    public function index() {
        $this->data['teamList'] = User::with('getMarks.Station')->where('role_id', 0)->orderBy('id', 'asc')->get();
        $this->data['stationList'] = User::where('role_id', 1)->orderBy('id', 'asc')->get();

        return view('admin.index')->with($this->data);
    }
}
