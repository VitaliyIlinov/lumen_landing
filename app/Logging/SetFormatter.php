<?php

namespace App\Logging;


class SetFormatter
{

    /**
     * Customize the given logger instance.
     *
     * @param  \Illuminate\Log\Logger $logger
     * @return void
     */
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
//            $handler->setFormatter(new CustomLineFormatter());
           $handler->setFormatter( new CustomJsonFormatter());
        }
    }
}