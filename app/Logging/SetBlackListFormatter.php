<?php

namespace App\Logging;


class SetBlackListFormatter
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
           $handler->setFormatter( new BlackListJsonFormatter());
        }
    }
}