<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Services\MlhApiService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    private $apiservice;
    public function __construct()
    {
        $this->apiservice = new MlhApiService();
    }
    public function index($operator_id)
    {

        $yesterday = Carbon::yesterday()->toDateTimeString();
$yesterday = Date('N', strtotime($yesterday));
$_today_day = Carbon::today()->dayOfWeekIso;

// Convert day of week to number
$day_map = [    'Monday' => 1,    'Tuesday' => 2,    'Wednesday' => 3,    'Thursday' => 4,    'Friday' => 5,    'Saturday' => 6,    'Sunday' => 7,];

if (isset($day_map[$_today_day])) {
    $_today_day = $day_map[$_today_day];
}

$operator = DB::table('operators')->where('operator_id', $operator_id)->get();
// $operator_games = DB::table('operator_games')
//     ->where('day_id', $_today_day)
//     ->orderBy('operator', 'desc')
//     ->get();
$operator_games = DB::table('operator_games')
    ->orderBy('operator', 'desc')
    ->get();


$next_game = DB::table('operator_games')
    ->join('operators', 'operator_games.operator', '=', 'operators.operator_id')
    ->select('operator_games.game_name', 'operator_games.end_time')
    ->where('operators.operator_id', $operator_id)
    ->where('end_time', '>', Carbon::now())
    ->where('day_id', $_today_day)
    ->orderBy('end_time', 'asc')
    ->first();


$results = DB::table('results')
    ->join('operator_games', 'results.game_id', '=', 'operator_games.game_id')
    ->join('operators', 'operator_games.operator', '=', 'operators.operator_id')
    ->select('results.id', 'results.game_id', 'operators.operator_id', 'results.winning_num', 'results.machine_num', 'results.created_at')
    ->where('operators.operator_id', $operator_id)
    ->orderBy('results.created_at', 'desc')
    ->groupBy('results.id', 'results.game_id', 'operators.operator_id', 'results.winning_num', 'results.machine_num', 'results.created_at')
    ->take(20) // limit to 20 results
    ->get();
    $images = Image::all();

        return view('viewmore', compact('results', 'operator', 'operator_games', 'next_game'))->with('image', $images);

    }    
}
