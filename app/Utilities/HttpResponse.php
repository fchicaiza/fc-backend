<?php

namespace App\Utilities;

class HttpResponse
{
    public static function success($data = null, $message = 'Success', $code = 200)
    {
        return self::response(true, $data, $message, $code);
    }

    public static function clientError($message = 'Client Error', $code = 400, $data = null)
    {
        return self::response(false, $data, $message, $code);
    }

    public static function serverError($message = 'Server Error', $code = 500, $data = null)
    {
        return self::response(false, $data, $message, $code);
    }

    private static function response($status, $data, $message, $code)
    {
        return [
            'status' => $status,
            'code' => $code,
            // 'message' => $message,
            // 'data' => $data,
        ];
    }
}
