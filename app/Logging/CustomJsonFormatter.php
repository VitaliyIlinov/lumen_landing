<?php

namespace App\Logging;


use Monolog\Formatter\JsonFormatter;

class CustomJsonFormatter extends JsonFormatter
{
    public function format(array $record)
    {
        $e = current($record['context']);
        $msg = '[object] (' . get_class($e) . '(code: ' . $e->getCode() . '): ' . $e->getMessage() . ')';
        $records = [
            'datetime' => $record['datetime']->format('Y-m-d H:i:s'),
            'ip' =>  request()->ip(),
            'level' => $record['level'],
            'level_name' => $record['level_name'],
            'request_uri' => request()->getRequestUri(),
            'file' => $e->getFile() . ':' . $e->getLine(),
            'message' => "$msg in File {$e->getFile()}:{$e->getLine()}.IP: ".request()->ip()." Request uri: " .request()->getRequestUri(),
        ];

        return parent::format($records);
    }

}