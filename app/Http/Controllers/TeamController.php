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

class TeamController extends Controller
{
    public function index() {
        $team_id = Auth::user()->id;
        
        $process = TeamProcess::with('Station')->where('team_id', $team_id)->orderBy('id', 'asc')->get();
        
        if(empty($process)) {
            $this->data['error'] = 'Không có bất kỳ trạm nào cho đội của bạn.';
        } else {
            $station = null;
            $team_process = null;
            
            foreach($process as $item) {
                if($item->is_passed == 0) {
                    $station = $item->Station;
                    $team_process = $item;
                    break;
                }
            }
            
            if(!is_null($station)) {
                $this->data['station'] = $station;
                $this->data['open_suggest'] = OpenSuggestion::where('team_id', $team_id)->where('station_id', $station->id)->first();
                
                if($team_process->answer == "1") {
                    $this->data['process'] = 1;
                } else {
                    $this->data['process'] = 0;
                }
            } else {
                $this->data['success_all'] = "Bạn đã hoàn thành tất cả các trạm. Vui lòng trở lại trạm đầu tiên....";
            }
            
        }
        return view('team.index')->with($this->data);
    }
    
    public function apiGetQuestion(Request $request) {
        $team_id = Auth::user()->id;
        $station_id = $request->station_id;
        
        $suggesstion = Suggestion::where('team_id',$team_id)->where('station_id', $station_id)->orderBy('id', 'asc')->first();
        
        if(is_null($suggesstion)) {
            $suggesstion = Suggestion::where('station_id', $station_id)->orderBy('id', 'asc')->first();
        }

        $process = TeamProcess::where('team_id', $team_id)->where('station_id', $station_id)->first();
        $process->answer = "1";
        $process->save();
        
        $this->data['suggestion'] = $suggesstion;
        
        $view = view('team.answer')->with($this->data)->render();
        
        return response()->json(['result' => 1, 'view' => $view]);
    }
    
    public function apiCheckAnswer(Request $request) {
        $suggesstion = Suggestion::find($request->suggest_id);
        $answer = $request->answer;
        
        if(strtolower($answer) == ($suggesstion->answer)) {
            return response()->json(['result' => 1]);
        }
        return response()->json(['result' => 0]);
    }

    public function apiExpiredQuestion(Request $request) {
        $team_id = Auth::user()->id;
        $station_id = $request->station_id;
        $result = $request->result;

        $process = TeamProcess::where('team_id', $team_id)->where('station_id', $station_id)->first();
        $process->check_answer_time = intval($result);
        
        $process->save();
        return "1";
    }
}
