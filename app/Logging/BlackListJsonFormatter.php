<?php

namespace App\Logging;


use Monolog\Formatter\JsonFormatter;

class BlackListJsonFormatter extends JsonFormatter
{
    public function format(array $record)
    {
        $records = [
            'datetime' => $record['datetime']->format('Y-m-d H:i:s'),
            'ip' =>  request()->ip(),
            'userAgent' =>  request()->userAgent(),
            'referer' => request()->server('HTTP_REFERER')
        ];

        return parent::format($records);
    }

}