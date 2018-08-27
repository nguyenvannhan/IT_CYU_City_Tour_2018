<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MarkCriteria;
use App\Models\TeamProcess;
use App\Models\OpenSuggestion;
use App\Models\Suggestion;
use App\Models\TeamMark;
use Illuminate\Support\Facades\Auth;

class StationController extends Controller
{
    public function index($team_id = 0) {
        $station_id = Auth::user()->id;
        
        $openSuggest = OpenSuggestion::where('team_id', $team_id)->where('station_id', $station_id)->orderBy('id', 'desc')->first();
        if(is_null($openSuggest)) {
            $this->data['suggestion_opened'] = 0;
        } else {
            $this->data['suggestion_opened'] = 1;
        }
        
        $this->data['teamList'] = User::getUserList([], '', 0);
        $this->data['team_id'] = $team_id;
        $this->data['mark_criterias'] = MarkCriteria::all();
        $this->data['team_routes'] = TeamProcess::with('Team', 'Station')->where('team_id', $team_id)->orderBy('id', 'asc')->get();
        $this->data['team_marks'] = TeamMark::with('Mark_Criteria')->where('station_id', $station_id)->where('team_id', $team_id)->orderBy('criteria_id', 'asc')->get();
        
        $this->data['station'] = User::with('Suggestions')->find($station_id);

        
        return view('station.index')->with($this->data);
    }
    
    public function apiPostOpenSuggestion(Request $request) {
        $suggestion = Suggestion::where('station_id', $request->station_id)->where('team_id', $request->team_id)->orderBy('id', 'desc')->first();
        
        if(is_null($suggestion)) {
            $suggestion = Suggestion::where('station_id', $request->station_id)->orderBy('id', 'desc')->first();
            
            if(is_null($suggestion)) {
                return response()->json(['result' => 0]);
            }
        }
        $openSuggest = OpenSuggestion::where('team_id', $request->team_id)->where('station_id', $request->station_id)->orderBy('id', 'desc')->first();
        if(is_null($openSuggest)) {
            $openSuggest = new OpenSuggestion;
        }
        $openSuggest->team_id = $request->team_id;
        $openSuggest->station_id = $request->station_id;
        $openSuggest->save();
        
        return response()->json(['result' => 1]);
    }

    public function apiPostSaveMark(Request $request) {
        foreach($request->mark_criteria_id as $index => $mark_id) {
            $teamMark = new TeamMark;
            $teamMark->team_id = $request->team_id;
            $teamMark->station_id = $request->station_id;
            $teamMark->criteria_id = $mark_id;

            $mark_criteria = MarkCriteria::find($mark_id);
            if($mark_criteria->max_mark >= 0) {
                $teamMark->mark = $request->mark[$index];
            } else {
                $teamMark->mark = -1 * $request->mark[$index];
            }

           $teamMark->save();
        }

        $team_process = TeamProcess::where('team_id', $request->team_id)->where('station_id', $request->station_id)->first();
        $team_process->is_passed = true;
        $team_process->save();

        $this->data['team_marks'] = TeamMark::with('Mark_Criteria')->where('station_id', $request->station_id)->where('team_id', $request->team_id)->orderBy('criteria_id', 'asc')->get();

        $view = view('station.mark')->with($this->data)->render();

        return response()->json(['result' => 1, 'view' => $view]);
    }

    public function apiGetContent($team_id) {
        $station_id = Auth::user()->id;
        
        $openSuggest = OpenSuggestion::where('team_id', $team_id)->where('station_id', $station_id)->orderBy('id', 'desc')->first();
        if(is_null($openSuggest)) {
            $this->data['suggestion_opened'] = 0;
        } else {
            $this->data['suggestion_opened'] = 1;
        }

        $this->data['team_id'] = $team_id;
        $this->data['mark_criterias'] = MarkCriteria::all();
        $this->data['team_routes'] = TeamProcess::with('Team', 'Station')->where('team_id', $team_id)->orderBy('id', 'asc')->get();
        $this->data['team_marks'] = TeamMark::with('Mark_Criteria')->where('station_id', $station_id)->where('team_id', $team_id)->orderBy('criteria_id', 'asc')->get();
        
        $this->data['station'] = User::with('Suggestions')->find($station_id);

        
        $view = view('station.content')->with($this->data)->render();

        return response()->json(['result' => 1, 'view' => $view]);
    }
}
