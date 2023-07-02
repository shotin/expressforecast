<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Result;
use App\Services\MlhApiService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ResultCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'call:result-api';

    protected $description = 'Call the result API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function getResult($gameId)
    {   
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

        $apiservice = new MlhApiService();
    
        // try {
                $results = $apiservice->getResults($gameId);            
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

        $operatorGames = DB::table('operator_games')->where('day_id', $_today_day)->orderBy('game_day', 'DESC')->get();
        foreach ($operatorGames as $result) {
            // dd($result->game_id);
            $this->getResult($result->game_id);
        }
    }
}
