<?php


namespace App\Logging;

use Monolog\Formatter\LineFormatter;

class CustomLineFormatter extends LineFormatter
{
    const SIMPLE_FORMAT = "[%datetime%] %request_uri% %level_name%: %context% %extra%\n";

    public function __construct(string $format = null, string $dateFormat = null, bool $allowInlineLineBreaks = true, bool $ignoreEmptyContextAndExtra = true)
    {
        parent::__construct($format, $dateFormat, $allowInlineLineBreaks, $ignoreEmptyContextAndExtra);
    }


    public function format(array $record)
    {
        $record['request_uri'] = request()->getRequestUri();
        return parent::format($record);
    }
}