<?php

class HttpStatus
{
    private static $http_error_messages = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Moved Temporarily',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Time-out',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Large',
        415 => 'Unsupported Media Type',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Time-out',
        505 => 'HTTP Version not supported'
    ];

    public static function getMessage($code)
    {
        if(array_key_exists($code, self::$http_error_messages))
            return self::$http_error_messages[$code];

        return 'Unknown http status code "' . htmlentities($code) . '"';
    }

    public static function http_return($code, $extra_msg = '', $die_app = true)
    {
        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ?
            $_SERVER['SERVER_PROTOCOL'] :
            'HTTP/1.1');

        header($protocol . ' '
            . $code
            . ' '
            . self::getMessage($code)
            . (empty($extra_msg) ? '' : ' ' . $extra_msg));

        if($die_app) {
            header('Content-Type: application/json');
            die(json_encode([
                'statuscode' => $code,
                'statusmsg' => self::getMessage($code) . (empty($extra_msg) ? '' : ' ' . $extra_msg)
            ]));
        }
    }
}
