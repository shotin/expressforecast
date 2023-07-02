<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;

class MlhApiService
{
    private $client, $headers;

    public function __construct()
    {
        $this->client = new Client(['verify' => false ]);
        $this->headers =
            [
                'Authorization' => 'Basic '.base64_encode('algo'.":".'mixjuice33').'',
                'Content-Type' => 'application/json'
            ];
    }

    public function getProviders()
    {
        $body = '{}';
        $request = new Request('POST', env("MLH_BASE_URL").'/get_operators', $this->headers, $body);
        $res = $this->client->sendAsync($request)->wait();
        return $res->getBody()->getContents();
    }

    public function getGames($operatorId)
    {
        $body = json_encode(
            [
                "operator_id" => $operatorId
            ]
        );
        $request = new Request('POST', env("MLH_BASE_URL") . '/get_games', $this->headers, $body);
        $res = $this->client->sendAsync($request)->wait();
        return $res->getBody()->getContents();
    }
    
    public function getResults($gameId, $date = '')
    {
        if ($date !== '') {
            $date = $date;
        } else {
            $date = Date('y-m-d');
        }

        $result = Http::withBasicAuth('algo', 'mixjuice33')->post('https://www.mylottohub.com/api/get_results', [
            "game_id"=> $gameId,
            "date" =>   $date
        ]);
        // dd(json_decode($result));
        return $result->body();
    }


    public function getForecasts($gameId, $operator)
    {
        $response = Http::withBasicAuth('algo', 'mixjuice33')->post('https://www.mylottohub.com/api/forecast', [
            "game_id"=> $gameId,
            "operator_id" =>  $operator
        ]);
    
        return $response->body();
    }
}
