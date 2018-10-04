<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait ApiResponse
{

    /**
     * @var string
     */
    protected $responseFormat;


    /**
     * Available response
     *
     * @var array
     */
    protected $availableFormat=['text', 'json'];


    protected abstract function getFilePath();

    /**
     * @return array
     */
    protected function jsonToArray($arr)
    {
        return array_map(function ($arr) {
            return json_decode($arr, true);
        }, $arr);
    }

    /**
     * Set format response from request.
     * Default text
     *
     * @return void
     */
    protected function setResponseFormat()
    {
        $request = request();
        if (in_array($format = $request->get('format'), $this->availableFormat)) {
            $this->responseFormat = $format;
        } else {
            $this->responseFormat = 'text';
        }
    }

    protected function getLogsArr()
    {
        $filePath = $this->getFilePath();
        if (File::exists($filePath)) {
            $data = file($filePath);
        }
        return $data ?: [];
    }

    /**
     * @param array $data
     * @return mixed
     */

    protected function response(array $data)
    {
        $responseMethod = strtolower($this->responseFormat) . 'Response';
        return $this->$responseMethod($data);
    }

    protected function jsonResponse($data)
    {
        return response()->json($data);
    }

    protected function textResponse($data)
    {
        return view('helpers.textResponse', ['data' => $data]);
    }

}