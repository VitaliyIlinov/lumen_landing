<?php

namespace App\Http\Controllers;

use App\Exceptions\BlackListException;
use App\Traits\ApiResponse;

class TrapController extends Controller
{

    use ApiResponse;


    public function blackList()
    {
        throw new BlackListException();
    }

    public function getBlacklist()
    {
        $this->setResponseFormat();
        $data = $this->jsonToArray($this->getLogsArr());
        return $this->response($data);
    }

    protected function getFilePath()
    {
        $loggingConfig = config('logging');
        return $loggingConfig['channels']['blacklist']['path'];
    }
}