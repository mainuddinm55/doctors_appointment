<?php

namespace app\base;

class Response
{
    public function statusCode(int $code)
    {
        http_send_status($code);
    }

    public function redirect($url)
    {
        header("Location: $url");
    }
}