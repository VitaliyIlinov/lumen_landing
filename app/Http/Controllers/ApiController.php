<?php

namespace App\Http\Controllers;

use App\Services\Fraud;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class ApiController extends Controller
{
    /**
     * @var string
     */
    private $responseFormat;

    private $configKeyRequired = [
        'PATH_CONFIG',
        'FRAUDFILTER',
        'FRAUD_URL',
        'FRAUD_KEY',
        'GET_TRACK_PARAMS',
        'BINOM_SERVER',
        'BINOM_KEY',
        'MONEY_TRACK_SERVER',
        'HASOFFERS_SERVER',
        'ACCESS_KEY',
        'TRACK_SERVER',
        'MONEY_TRACK_SERVER',
        'LOG_PERIOD',
        'LAST_LOG_ERRORS'
    ];

    private $responseMsg = [
        'status' => '',
        'errorMessage' => '',
        'config' => '',
        'pages' => '',
        'cloaking' => '',
        'lastErrors' => ''
    ];
    private $errors = [];

    public function __construct()
    {
        app()->configure('logging');
    }


    public function getState(Request $request)
    {
        $this->setResponseFormat();
        $this->setAllParams($request);
        return $this->response();
    }

    public function getHeartbeat(Request $request)
    {
        $this->setResponseFormat();
        $this->setAllParams($request);
        return $this->response(['status', 'errorMessage', 'errorCount']);
    }

    public function getLogs(Request $request)
    {
        $lastLogErrors = $request->get('last_log', env('LAST_LOG_ERRORS'));
        $data = array_slice($this->getLogsArr(), -1 * abs($lastLogErrors));
        return $this->textResponse($this->jsonToArray($data));
    }


    private function setResponseFormat(array $availableFormat = ['text', 'json'])
    {
        $request = request();
        if (in_array($format = $request->get('format'), $availableFormat)) {
            $this->responseFormat = $format;
        } else {
            $this->responseFormat = 'text';
        }
    }

    private function setAllParams(Request $request)
    {
        $this->setConfig();
        $this->setCloaking();
        $this->setPages();
        $logs = $this->jsonToArray($this->getLogsArr());
        $this->setLastError($logs);
        $this->setErrorCountPeriod($logs, env('LOG_PERIOD'));
        $this->setStatus();
    }

    private function setStatus()
    {
        $this->responseMsg['errorMessage'] = $this->errors ?: null;
        $this->responseMsg['status'] = $this->errors ? 'ERROR' : 'READY';
    }

    private function pushErrors($msg)
    {
        return $this->errors[] = $msg;
    }

    private function response(array $key = [])
    {
        $responseMethod = strtolower($this->responseFormat) . 'Response';
        if ($key) {
            return $this->$responseMethod(Arr::only($this->responseMsg, $key));
        }
        return $this->$responseMethod($this->responseMsg);
    }

    private function jsonResponse($data)
    {
        return response()->json($data);
    }

    private function textResponse($data)
    {
        return view('helpers.textResponse', ['data' => $data]);
    }

    private function setConfig()
    {
        foreach ($this->configKeyRequired as $item) {
            $value = env($item);
            if (empty($value)) {
                $this->pushErrors("KEY {$item} in env is empty");
                $result[$item] = NULL;
            } else {
                $result[$item] = $value;
            }
        }

        $this->responseMsg['config'] = $result;
    }

    private function setErrorCountPeriod($logs, $period)
    {
        $period = strtotime($period);
        array_map(function ($arr) use ($period, &$result) {
            if (strtotime($arr['datetime']) > $period) {
                $result[] = $arr;
            }
        }, $logs);

        $this->responseMsg['errorCount'] = count($result ?: []);
    }

    private function jsonToArray($arr)
    {
        return array_map(function ($arr) {
            return json_decode($arr, true);
        }, $arr);
    }

    private function getLogsArr()
    {
        $loggingConfig = config('logging');
        $filePath = $loggingConfig['channels'][$loggingConfig['default']]['path'];
        if (File::exists($filePath)) {
            $data = file($filePath);
        } else {
            $this->pushErrors("FILE {$filePath} doesn't exist");
        }
        return $data ?: [];
    }

    private function setLastError($logs)
    {
        $lastError = end($logs);
        $this->responseMsg['lastErrors'] = [
            'timestamp' => $lastError ? $lastError['datetime'] : null,
            'message' => $lastError ? $lastError['message'] : null
        ];
    }

    private function setCloaking()
    {
        $fraud = new Fraud(request());
        try {
            $testStatus = $fraud->getStatus();
            $enabled = boolval($fraud->isCloaked());
        } catch (ClientException $e) {
            $testStatus = $e->getCode();
            $enabled = false;
            $this->pushErrors("FRAUD ERROR {$e->getCode()} : {$e->getMessage()} ");
        }
        $this->responseMsg['cloaking'] = [
            'campaignId' => parse_url(env('FRAUD_URL'), PHP_URL_PATH),
            'testStatus' => $testStatus,
            'enabled' => $enabled,
        ];

    }

    private function setPages()
    {
        if (!$safeView = View::exists('Safe::index')) {
            $this->pushErrors("safe.index doesn't exist");
        }
        if (!$moneyView = View::exists('Money::index')) {
            $this->pushErrors("money.index doesn't exist");
        }
        if (200 !== ($safeStatus = $this->getStatus('safe')->getStatusCode())) {
            $this->pushErrors("safe.index status {$safeStatus}");
        }
        if (200 !== ($moneyStatus = $this->getStatus('money')->getStatusCode())) {
            $this->pushErrors("safe.index status {$moneyStatus}");
        }

        $this->responseMsg['pages'] = [
            'safe' => [
                'exists' => $safeView,
                'httpStatus' => $safeStatus,
            ],
            'money' => [
                'exists' => $moneyView,
                'httpStatus' => $moneyStatus,
                'pageConfig' => $this->getJsConfig()
            ],
        ];
    }

    private function getJsConfig()
    {
        $pathMoneyConfigJs = base_path(env('PATH_CONFIG'));
        if (!File::exists($pathMoneyConfigJs)) {
            $this->pushErrors("{$pathMoneyConfigJs} doesn't exist");
            return false;
        }
        $jsContent = file_get_contents($pathMoneyConfigJs);
        $jsConfig = trim(stristr(str_replace('var CONFIG = ','',$jsContent), 'var formsList', true));
        if (substr($jsConfig, -1) == ';') {
            $jsConfig = substr($jsConfig, 0, -1);
        }
        return json_decode($jsConfig,true);
    }

    private function getStatus($routeName)
    {
        $response = Request::create(URL::route($routeName), 'GET', request()->all());
        return app()->handle($response);
    }

}