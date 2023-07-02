<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\forecast;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Services\MlhApiService;
// use Illuminate\Support\Facades\Http;

class CallForecastApi extends Command
{
    protected $signature = 'call:forecast-api';

    protected $description = 'Call the forecast API';

    public function getForecast($gameId, $operator)
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
     
      
            $apiservice = new MlhApiService();
          
            $forecast = $apiservice->getForecasts($gameId, $operator);
        
            $decoded = json_decode($forecast, true);
            if (isset($decoded["data"])) {
                $numbers = $decoded["data"]["numbers"];
                $numbers = $decoded["data"]["numbers"];
                $newArray = array_slice($numbers, 0, 13);
                $chunck = array_chunk($newArray, 5, false);
                $startDate = Carbon::now()->subDays(7);
                $endDate = Carbon::now(); 
                $check    = forecast::whereBetween('created_at', [$startDate, $endDate])->whereGame_id($gameId)->get();
                $startTime = DB::table('operator_games')->select('start_time', 'day_id')->where('game_id', $gameId)->where('day_id', $_today_day)->get()[0];
                $time = $startTime->start_time;
               
                if ($check->isEmpty()) {
                    $forecast = new forecast();
                    $forecast->game_id = $gameId;
                    $forecast->day_id = $_today_day;
                    $forecast->operator = $operator;
                    $forecast->start_time = $time;
                    $forecast->option_a = $chunck[0];
                    $forecast->option_b = $chunck[1];
                    $forecast->option_c = $chunck[2];
                    $forecast->save();
                }
            } else {
                // Handle error - maybe return an error response or throw an exception
            }
    }

    public function handle()
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
      
        $operatorGames = DB::table('operator_games')->where('day_id', $_today_day)->orderBy('day_id', 'desc')->get();
        // dd($operatorGames);

        foreach ($operatorGames as $forecast) {
            $this->getForecast($forecast->game_id, $forecast->operator);
        }
    }
}


