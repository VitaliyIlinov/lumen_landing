<?php

namespace App\Traits;


trait formRequest
{

    public function sendFormRequest(string $uri, $params, $formRequest = 'form_params', $method = 'POST')
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request($method, $uri, [
            $formRequest => $params
        ]);

        return $response;
    }

    public function getBinomFormRequest()
    {
        $result = [];
        $response = $this->sendFormRequest(env('BINOM_SERVER') . '/click.php?key=' . env('BINOM_KEY'), false, 'allow_redirects', 'GET');
        if ($response->hasHeader('Location')) {
            $url = $response->getHeader('Location')[0];
            $response = $this->sendFormRequest($url, false, 'allow_redirects', 'GET');
            if ($response->hasHeader('Location')) {
                $url = $response->getHeader('Location')[0];
            }
            parse_str(parse_url($url, PHP_URL_QUERY), $result);
        }
        return $result;
    }

    public function getTransactionIdFormRequest()
    {
        if(!session()->has(['offer_id', 'affiliate_id'])){
            throw new \Exception("There are no offers and affiliates",303);
        }
        $params = http_build_query([
            'offer_id'=>session()->get('offer_id'),
            'aff_id'=>session()->get('affiliate_id')
            ]
        );
        $response = $this->sendFormRequest(env('HASOFFERS_SERVER') . '/aff_c?' . $params, false, 'allow_redirects', 'GET');
        return $response->hasHeader('tracking_id') ? $response->getHeader('tracking_id')[0] : '';
    }

    public function checkPhoneRequest(string $phone = null)
    {
        return $this->sendFormRequest(env('MONEY_TRACK_SERVER') . '/check/phone', $phone ? ['phone' => $phone] : request()->only('phone'), 'json');
    }

    public function sendDataForm(array $data = [])
    {
        return $this->sendFormRequest(env('MONEY_TRACK_SERVER') . '/sendForm', $data ?: request()->all(), 'json');
    }



}