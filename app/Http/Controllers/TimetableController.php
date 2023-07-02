<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Operator;
use App\Models\OperatorGames;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimetableController extends Controller
{
    public function index()
    {
        $data = [];
        $data['operators'] = Operator::all();

        // $operator = $data['operators']->last()->operator_id;
        $day = (new DateTime())->format('N');
        $_today_date = strtotime(date('Y-m-d'));
        $_today_day = date('l', $_today_date);
        if (isset($_GET['op']) && $_GET['did']) {
            $operator = $_GET['op'];
            $day = $_GET['did'];
            $data['timetable'] = OperatorGames::whereOperatorAndDay_id($operator,  $day)->get();             
        } else {
            // $operators = DB::table('operators')->get();
            // dd($_today_day);
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
            // foreach($operators as $key => $opt){
                // $dat = OperatorGames::whereDay_id(2)->get();
                $dat_opt_gm = DB::table('operator_games')->where('day_id', $_today_day)->orderBy('start_time', 'ASC')->get()->sortBy('start_time');
                $dat_opt_gm = collect($dat_opt_gm);
                // dd($dat[0]->id); 
                // dd(count($dat_opt_gm));
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
            $data['timetable'] = $data_;
            //OperatorGames::whereOperatorAndDay_id($operator, $day)->get();    
        }
        // dd($data['timetable']);
        $image = Image::all();
        return view('timetable', $data, ['image' => $image]);
    }
}
