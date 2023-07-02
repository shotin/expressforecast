<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Result;
use App\Services\MlhApiService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ResultsController extends Controller
{
    private $apiservice;
    public function __construct()
    {
        $this->apiservice = new MlhApiService();
    }
    public function index()
    {
        $yesterday = Carbon::yesterday()->toDateTimeString();
        $yesterday = Date('N', strtotime($yesterday));
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
        

    $results = DB::table('results')
        ->join('operator_games', 'results.game_id', '=', 'operator_games.game_id')
        ->join('operators', 'operator_games.operator', '=', 'operators.operator_id')
        ->select('results.id', 'results.game_id', 'operators.operator_id', 'results.winning_num', 'results.machine_num', DB::raw('MAX(results.created_at) as created_at'))
        ->groupBy('operator_games.operator', 'results.game_id',  'results.id', 'operators.operator_id', 'results.winning_num', 'results.machine_num')
        ->orderBy('created_at', 'desc')
        ->get();

$resultsByOperator = [];
foreach ($results as $result) {
    $resultsByOperator[$result->operator_id][] = $result;
}

$operator_games = DB::table('operator_games')
    ->orderBy('operator', 'desc')
    ->get();
$operators = DB::table('operators')->get();
$images = Image::all();

return view('results', [
    'resultsByOperator' => $resultsByOperator,
    'operators' => $operators,
    'operator_games' => $operator_games,
    'allDays' => $allDays
])->with('image', $images);
}

public function getResult($gameId) {   
        // // try {
        //     $gameId = $operatorGames->first()->game_id;
        // $todayNumeric = (new DateTime())->format('N');
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
    
        // try {
                $results = $this->apiservice->getResults($gameId);            
                $decoded = json_decode($results, true);
               
                $status = $decoded['status'];
                if ($status !== 'failed') {
                    // $result =  $decoded['data']['result'];
                    // $winning = explode('-', $result->winning_number);
                $resultwin =  $decoded['data']['result'][0]['winning_number'];
                $resultmachine =  $decoded['data']['result'][0]['machine_number'];
                $date = $decoded['data']['result'][0]['date'];
              
                $winning = explode('-', $resultwin);
                $machineNumber = explode('-', $resultmachine);
                $today = Carbon::today()->toDateTimeString();
                // dd($_today_day);
                $startDate = Carbon::createFromFormat('Y-m-d h:i:s',  $today)->startOfDay()->toDateTimeString();
                $endDate = Carbon::createFromFormat('Y-m-d h:i:s', $today)->endOfDay()->toDateTimeString();

                $check = Result::whereGame_id($gameId)->whereBetween('created_at', [$startDate, $endDate])->get();

                if ($check->isEmpty()) {
                    $newResult = new Result();
                    // dd($newResult);
                    $newResult->game_id = $gameId;
                    $newResult->day_id = $_today_day;
                    $newResult->machine_num = $machineNumber;
                    $newResult->winning_num = $winning;
                    $newResult->created_at = $date;
                    $newResult->save();
                }
            }
            // } catch (\Throwable $th) {
            //     $result = Result::latest()->select('game_id')->first();
            //     $gameId = $result->game_id;
            //     //throw $th;
            // }
    
    }

    public function todayResults()
    {
      
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

        // $operatorGames = OperatorGames::whereDay_id($todayNumeric)->orderBy('day_id', 'ASC')->orderBy('game_id', 'ASC')->orderBy('operator', 'ASC')->get();;
        $operatorGames = DB::table('operator_games')->where('day_id', $_today_day)->orderBy('game_day', 'DESC')->get();
        foreach ($operatorGames as $result) {
            // dd($result->game_id);
            $this->getResult($result->game_id);
        }
    }
}
