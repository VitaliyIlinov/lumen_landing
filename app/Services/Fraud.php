<?php

namespace App\Services;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class Fraud
{

    private $allHeaders = [];
    private $request;
    private $response = null;


    public function __construct(Request $request)
    {
        $headers = $request->headers->all();

        $this->request = $request;

        if (!env('FRAUD_URL') || !env('FRAUD_KEY')) {
            throw new \Exception('FRAUD_URL and FRAUD_KEY must be set');
        }

        $this->allHeaders['content-length'] = 0;
        $this->allHeaders['X-FF-P'] = env('FRAUD_KEY');

        $this->addHeader($headers, 'X-FF-REMOTE-ADDR', 'REMOTE_ADDR');
        $this->addHeader($headers, 'X-FF-X-FORWARDED-FOR', 'HTTP_X_FORWARDED_FOR');
        $this->addHeader($headers, 'X-FF-X-REAL-IP', 'HTTP_X_REAL_IP');
        $this->addHeader($headers, 'X-FF-DEVICE-STOCK-UA', 'HTTP_DEVICE_STOCK_UA');
        $this->addHeader($headers, 'X-FF-X-OPERAMINI-PHONE-UA', 'HTTP_X_OPERAMINI_PHONE_UA');
        $this->addHeader($headers, 'X-FF-HEROKU-APP-DIR', 'HEROKU_APP_DIR');
        $this->addHeader($headers, 'X-FF-X-FB-HTTP-ENGINE', 'X_FB_HTTP_ENGINE');
        $this->addHeader($headers, 'X-FF-X-PURPOSE', 'X_PURPOSE');
        $this->addHeader($headers, 'X-FF-REQUEST-SCHEME', 'REQUEST_SCHEME');
        $this->addHeader($headers, 'X-FF-CONTEXT-DOCUMENT-ROOT', 'CONTEXT_DOCUMENT_ROOT');
        $this->addHeader($headers, 'X-FF-SCRIPT-FILENAME', 'SCRIPT_FILENAME');
        $this->addHeader($headers, 'X-FF-REQUEST-URI', 'REQUEST_URI');
        $this->addHeader($headers, 'X-FF-SCRIPT-NAME', 'SCRIPT_NAME');
        $this->addHeader($headers, 'X-FF-PHP-SELF', 'PHP_SELF');
        $this->addHeader($headers, 'X-FF-REQUEST-TIME-FLOAT', 'REQUEST_TIME_FLOAT');
        $this->addHeader($headers, 'X-FF-COOKIE', 'HTTP_COOKIE');
        $this->addHeader($headers, 'X-FF-ACCEPT-ENCODING', 'HTTP_ACCEPT_ENCODING');
        $this->addHeader($headers, 'X-FF-ACCEPT-LANGUAGE', 'HTTP_ACCEPT_LANGUAGE');
        $this->addHeader($headers, 'X-FF-CF-CONNECTING-IP', 'HTTP_CF_CONNECTING_IP');
        $this->addHeader($headers, 'X-FF-INCAP-CLIENT-IP', 'HTTP_INCAP_CLIENT_IP');
        $this->addHeader($headers, 'X-FF-QUERY-STRING', 'QUERY_STRING');
        $this->addHeader($headers, 'X-FF-X-FORWARDED-FOR', 'X_FORWARDED_FOR');
        $this->addHeader($headers, 'X-FF-ACCEPT', 'HTTP_ACCEPT');
        $this->addHeader($headers, 'X-FF-X-WAP-PROFILE', 'X_WAP_PROFILE');
        $this->addHeader($headers, 'X-FF-PROFILE', 'PROFILE');
        $this->addHeader($headers, 'X-FF-WAP-PROFILE', 'WAP_PROFILE');
        $this->addHeader($headers, 'X-FF-REFERER', 'HTTP_REFERER');
        $this->addHeader($headers, 'X-FF-HOST', 'HTTP_HOST');
        $this->addHeader($headers, 'X-FF-VIA', 'HTTP_VIA');
        $this->addHeader($headers, 'X-FF-CONNECTION', 'HTTP_CONNECTION');
        $this->addHeader($headers, 'X-FF-X-REQUESTED-WITH', 'HTTP_X_REQUESTED_WITH');
        $this->addHeader($headers, 'User-Agent', 'HTTP_USER_AGENT');
        $this->addHeader($headers, 'Expected', '');

        $cnt = 0;
        foreach ($this->getallheadersFF() as $key => $value) {
            $k = strtolower($key);
            if ($k === 'host') {
                $this->allHeaders['X-FF-HOST-ORDER'] = $cnt;
                break;
            }
            $cnt++;
        }
    }


    public function addHeader($header, $out, $in)
    {
        if (isset($_SERVER[$in])) {
            $value = $_SERVER[$in];
            if (is_array($value)) {
                $value = implode(',', $value);
            }
            $this->allHeaders[$out] = $value;
        }
    }

    function getallheadersFF()
    {
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers ?: [];
    }


    public function getHeaders()
    {
        return $this->allHeaders;
    }


    public function sendFraudRequest()
    {
        if (is_null($this->response)) {

            $client = new \GuzzleHttp\Client();

            try {
                $this->response = $client->request('POST', env('FRAUD_URL'), ['headers' => $this->allHeaders]);
            } catch (ClientException $e) {
                throw new ClientException($e->getResponse()->getReasonPhrase(), $e->getRequest(), $e->getResponse());
            }
        }
        return $this->response;
    }

    public function isCloaked()
    {
        $response = $this->sendFraudRequest();
        return explode(';', $response->getBody()->getContents())[0];
    }

    public function getStatus()
    {
        return $this->sendFraudRequest()->getStatusCode();
    }

}