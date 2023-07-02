<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Operator;
use App\Models\OperatorGames;
use App\Services\MlhApiService;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{

    private $mlhApiService;
    public function __construct()
    {
        $this->mlhApiService = new MlhApiService();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $operators = Operator::all();

        // try {
        //     if ($operators->isEmpty()) {
        //         $providers = json_decode($this->mlhApiService->getProviders(), true, JSON_THROW_ON_ERROR);
        //         $data = $providers['data']['result'];

        //         foreach ($data as $key => $value) {
        //             $operator = new Operator();
        //             $operator->operator_id = $value['operator_id'];
        //             $operator->operator_name = $value['name'];
        //             $operator->save();
        //         }
        //     }
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }

        // $operatorGames = OperatorGames::all();

        // try {
        //     if ($operatorGames->isEmpty()) {

        //         foreach ($operators as $key => $value) {
        //             $operator_id = $value->operator_id;

        //             $operatorGames = json_decode($this->mlhApiService->getGames($operator_id), true, JSON_THROW_ON_ERROR);
        //             $games = $operatorGames['data']['result'];
        //             $this->saveGame($games, $operator_id);
        //         }
        //     }
        // } catch (\Throwable $th) {
        //     throw $th;
        // }
    }

    // private function saveGame(array $games, $operator_id)
    // {
    //     foreach ($games as  $key => $value) {
    //         $operator = new OperatorGames();
    //         $operator->game_id = $value['game_id'];
    //         $operator->operator = $operator_id;
    //         $operator->game_name = $value['game_name'];
    //         $operator->game_day = $value['day'];
    //         $operator->day_id = $value['day_no'];
    //         $operator->start_time = $value['start_time'];
    //         $operator->end_time = $value['end_time'];
    //         $operator->save();
    //     }
    // }
}
