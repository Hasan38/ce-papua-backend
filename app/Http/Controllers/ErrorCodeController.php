<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\SearchErrorCodeRequest;
use GuzzleHttp\Client;


class ErrorCodeController extends Controller
{
   

    public function index(SearchErrorCodeRequest $request){
        $data = $request->validated();
        $client = new Client();

        $options = [
            'verify' => false,
            'Accept' => 'application/json', 
        ];
        try{
        $response = $client->get('https://app.hitachi-omron-ts.com/api/ErrorCodes00/ecs?code='
        .$data['code'].'&model='.$data['model'], $options)->getBody()->getContents();
        $response_json = json_decode($response);
            return ApiResponseClass::sendResponse(['error' => $response_json],'',200);
        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }
}
