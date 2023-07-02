<?php

namespace App\Http\Controllers;

use App\Models\forecast;
use App\Models\Image;
use App\Models\Operator;
use App\Models\OperatorGames;
use App\Models\Result;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WinningHistoryController extends Controller
{
    public function index()
    {
        $data = [];
        $data['operators'] = Operator::all();
        $day = (new DateTime())->format('N');
        $_today_date = strtotime(date('Y-m-d'));
        $_today_day = date('l', $_today_date);
        if (isset($_GET['op']) && $_GET['did']) {
            $operator = $_GET['op'];
            $day = $_GET['did'];
            $data['history'] = OperatorGames::whereOperatorAndDay_id($operator,  $day)->get();             
        } else {
            $allDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            if($_today_day == $allDays[0]){
                $_today_day = 1;
            }
            if($_today_day == $allDays[1]){
                $_today_day = 2;
            }
            if($_today_day == $allDays[2]){
                $_today_day = 3;
            }
            if($_today_day == $allDays[3]){
                $_today_day = 4;
            }
            if($_today_day == $allDays[4]){
                $_today_day = 5;
            }
            if($_today_day == $allDays[5]){
                $_today_day = 6;
            }
            if($_today_day == $allDays[6]){
                $_today_day = 7;
            }
            $data_ = Array();
        
                $dat_opt_gm = DB::table('operator_games')->where('day_id', $_today_day)->orderBy('start_time', 'ASC')->get()->sortBy('start_time');
                $dat_opt_gm = collect($dat_opt_gm);
               
                $dat   = $dat_opt_gm;
                for($key = 0; $key < count($dat_opt_gm); $key++){      
                $data_store = array(
                    "id"         => $dat[$key]->id,
                    "operator"   => $dat[$key]->operator,
                    "game_id"    => $dat[$key]->game_id,
                    "game_name"  => $dat[$key]->game_name,
                    "game_day"   =>$dat[$key]->game_day,
                    "day_id"     => $dat[$key]->day_id,
                    "start_time" => $dat[$key]->start_time,
                    "end_time"   => $dat[$key]->end_time,
                    "created_at" =>$dat[$key]->created_at,
                    "updated_at" => $dat[$key]->updated_at,
                );
                 array_push($data_, $data_store);
            }
            $data['history'] = $data_;
        }
        // dd($data['timetable']);
        $image = Image::all();

        $results = Result::orderBy('created_at', 'desc')->paginate(19);
        
        return view('history', $data, ['image' => $image, 'results' => $results]);
    }

    public function show(Request $request) {
        // $data = new OperatorGames();
        // $operators = DB::table('operators')->get();  ->unique('game_id')
        $data = DB::table('operator_games')->where('operator', $request->operator_id)->orderBy('operator', 'desc')->get();
        
        return response()->json($data);

    }

    public function show_js(Request $request) {
        $_today_date = strtotime(date('Y-m-d'));
        $_today_day = date('l', $_today_date);
        $allDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            if($_today_day == $allDays[0]){
                $_today_day = 1;
            }
            if($_today_day == $allDays[1]){
                $_today_day = 2;
            }
            if($_today_day == $allDays[2]){
                $_today_day = 3;
            }
            if($_today_day == $allDays[3]){
                $_today_day = 4;
            }
            if($_today_day == $allDays[4]){
                $_today_day = 5;
            }
            if($_today_day == $allDays[5]){
                $_today_day = 6;
            }
            if($_today_day == $allDays[6]){
                $_today_day = 7;
            }

            if($request->game_id == 'all'){
        

                $data = Array();
                   
                $result_forcast = DB::table('forecasts')->where('operator', $request->operator_id)->orderBy('created_at', 'desc')->get();
                foreach($result_forcast as $res_for){
                    $_items = Array();
                $results = DB::table('results')->select('winning_num', 'created_at', 'game_id', 'day_id' )->where('game_id', $res_for->game_id)->orderBy('created_at', 'desc')->get();
                $true_check = 0;
                foreach($results as $res){
                    if($res_for->day_id == $res->day_id){
                        $operator_games = DB::table('operator_games')->select('game_name')->where('game_id', $res_for->game_id)->where('operator', $request->operator_id)->get();
                        $g_m = '';
                        foreach($operator_games as $opt_gm){
                                $g_m = $opt_gm->game_name;
                        }
                    $_items = array(
                            'game_name'=>$g_m,
                            'winning_num'=>$res->winning_num,
                            'created_at'=>$res_for->created_at,
                            'option_a'=>$res_for->option_a,
                            'option_b'=>$res_for->option_b,
                            'option_c'=>$res_for->option_c,
                            'game_id'=>$res_for->game_id
                    );
                    $true_check = 1;
                }
                    
                }
                if($true_check == 1){
                array_push(                    
                        
                    $data,
                    $_items
    
                );
                $true_check = 0;
            }
    
                }




            }else{

        $data = Array();
                   
            $result_forcast = DB::table('forecasts')->where('game_id', $request->game_id)->where('operator', $request->operator_id)->orderBy('created_at', 'desc')->get();
            foreach($result_forcast as $res_for){
                $_items = Array();
            $results = DB::table('results')->select('winning_num', 'created_at', 'game_id', 'day_id' )->where('game_id', $res_for->game_id)->get();
            $true_check = 0;
            foreach($results as $res){
                if($res_for->day_id == $res->day_id){
                $_items = array(
                    'game_name'=>'',
                        'winning_num'=>$res->winning_num,
                        'created_at'=>$res_for->created_at,
                        'option_a'=>$res_for->option_a,
                        'option_b'=>$res_for->option_b,
                        'option_c'=>$res_for->option_c,
                        'game_id'=>$res_for->game_id
                );
                $true_check = 1;
            }
                
            }
            if($true_check == 1){
            array_push(                    
                    
                $data,
                $_items

            );
            $true_check = 0;
        }

            }
        }
        return response()->json($data);

    }
}
