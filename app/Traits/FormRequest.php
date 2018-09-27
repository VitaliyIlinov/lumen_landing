<?php

namespace App\Traits;


use App\Exceptions\LogException;

trait FormRequest
{

    private function getClient()
    {
        return new \GuzzleHttp\Client();
    }

    public function sendFormRequest(string $uri, $params, $formRequest = 'form_params', $method = 'POST')
    {
        $client = $this->getClient();
        $response = $client->request($method, $uri, [
            $formRequest => $params
        ]);

        return $response;
    }

    private function getBinomFormRequest()
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

    private function getTransactionIdFormRequest()
    {
        if (!session()->has(['offer_id', 'affiliate_id'])) {
            throw new LogException("There are no offers and affiliates", 303);
        }
        $params = http_build_query([
                'offer_id' => session()->get('offer_id'),
                'aff_id' => session()->get('affiliate_id')
            ]
        );
        $response = $this->sendFormRequest(env('HASOFFERS_SERVER') . '/aff_c?' . $params, false, 'allow_redirects', 'GET');
        return $response->hasHeader('tracking_id') ? $response->getHeader('tracking_id')[0] : '';
    }

    private function moneyTrackRequest($path, array $arr, $formRequest = 'json')
    {
        return $this->sendFormRequest(env('MONEY_TRACK_SERVER') . $path, $arr, $formRequest)->getBody()->getContents();
    }

    private function sendDataFormTrack(array $data)
    {
        return $this->sendFormRequest(env('TRACK_SERVER'), $data, 'json');
    }

}