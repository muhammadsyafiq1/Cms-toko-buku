<?php

namespace App\Http\Controllers\API;

class ResponseFormatter {
    protected static $response = [
        'meta' => [
            'code' => 200,
            'status' => 'success',
            // 'massage' => null
        ],

        'data' => null
    ];

    //FUNGSI OUTPUT DATA KALAU SUKES
    //META ADALAH HASIL PROTOKOL DARI API DATA (OPTIONAL )
    public static function success($data = null, $message = null)
    {
        self::$response['meta']['message'] = $message; //MENYIMPAN MASSAGE KE VARIABLE STATIC RESPONSE
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    //FUNGSI OUTPUT DATA KALAU ERROR
    public static function error($data = null, $message = null, $code=400)
    {
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['code'] = $code;
        self::$response['meta']['massage'] = $message; 
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }
}