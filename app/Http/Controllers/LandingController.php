<?php

namespace App\Http\Controllers;

use App\Exceptions\LogException;
use App\Services\Fraud;
use App\Traits\FormRequest;
use App\Traits\SubscriberInfo;
use CodeOrange\GeoIP\GeoIP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class LandingController extends Controller
{
    use FormRequest, SubscriberInfo;

    protected $rules = [
        'first_name' => 'required|string|min:1|max:50',
        'last_name' => 'required|string|min:1|max:50',
        'email_address' => 'required|email',
        'phone' => 'required|string|min:5|max:30',
        'countryISO' => 'required|string|size:2',
        'aff_id' => 'required|string|sometimes',
        'affiliate_id' => 'required|string|sometimes',
        'aff_sub' => 'required|string|sometimes',
        'offer_id' => 'required|string|sometimes',
        'transaction_id' => 'string|sometimes',
        'plid' => 'required|string|sometimes',
        'tsid' => 'required|string|sometimes',
        'buid' => 'required|string|sometimes',
        'bcamp_id' => 'required|string|sometimes',
        'bo' => 'string|sometimes',
        'so' => 'string|sometimes',
        'source_id' => 'required|string|sometimes',
        'registration' => 'required|sometimes',
        'redirectTarget' => 'required|in:deposit,platform,webpage|sometimes',
        'comment' => 'required|string|sometimes|max:150',
        'password' => 'required|sometimes|min:6|max:30',
        'referrer' => 'required|string|sometimes|min:1|max:20',
        'sourceId' => 'required|string|sometimes|min:1|max:20',
        'externalId' => 'required|string|sometimes|min:2|max:30',
        'custom' => 'string|sometimes',
    ];

    /**
     * key - api key
     * value - key from front
     * also value can be method class as ip or
     * function as accessKey
     */
    protected $apiMatchingArr = [
        'firstName' => 'first_name',
        'lastName' => 'last_name',
        'email' => 'email_address',
        'phone' => 'phone',
        'country' => 'countryISO',
        'password' => 'password',
        'comment' => 'comment',
        'ip' => 'M::getClientIp',
        'accessKey' => 'F::return env(\'ACCESS_KEY\');',
        'referrer' => 'referrer',
        'sourceId' => 'source_id',
        'externalId' => 'transaction_id',
        'custom' => 'custom'
    ];

    protected $rulesMessage = [];

    public function __construct()
    {
        $this->setSessionData(env('GET_TRACK_PARAMS') == 'clicks'
            ? $this->getBinomFormRequest()
            : request()->all());
        $this->setTransactionId();
    }

    public function page(Request $request)
    {
        switch (session()->get('pageType')) {
            case Fraud::MONEY:
                return $this->getMoneyPage();
            case Fraud::SAFE:
            default:
                return $this->getSafePage();
        }
    }

    public function getMoneyPage()
    {
        if (View::exists('Money::index')) {
            return view('Money::index', [
                'request' => request()->all()
            ]);
        }
        throw new LogException('Not found view money.index', 303);
    }

    public function getSafePage()
    {
        if (View::exists('Safe::index')) {
            return view('Safe::index', [
                'request' => request()->all()
            ]);
        }
        throw new LogException('not found view safe.index', 303);
    }


    public function send(Request $request)
    {
        $this->validate($request, $this->rules, $this->rulesMessage);

        if (env('GET_TRACK_PARAMS') == 'conversions') {
            $this->setSessionData($this->getBinomFormRequest());
        }

        $this->setTransactionId();

        //todo priority??
        $request->merge($this->getTrackParams());

        $inputs = $request->all();
        $data = $this->prepareApiArr($inputs);
        $data['custom'] = serialize($inputs);
        return $this->sendDataFormTrack($data);
    }

    protected function prepareApiArr(array &$data)
    {
        array_filter($this->apiMatchingArr, function ($v, $k) use (&$data, &$result) {
            if (strpos($v, 'M::') !== false) {
                $methodName = explode('|', substr($v, 3));
                $result[$k] = $this->{$methodName[0]}($methodName[1] ?? null);
            } elseif (strpos($v, 'F::') !== false) {
                $string = substr($v, 3);
                $result[$k] = eval($string);
            } elseif (isset($data[$v])) {
                $result[$k] = $data[$v];
            }
            unset($data[$v]);
        }, ARRAY_FILTER_USE_BOTH);

        return $result;
    }

    public function getGeoCountry()
    {
        $path = env('MONEY_MAKE_SERVER') . '/geoip/';
        return $this->sendFormRequest($path, null, null)->getBody()->getContents();
    }

    public function checkEmail(Request $request)
    {
        $path = '/check/email';
        return $this->moneyTrackRequest($path, ['email_address' => $request->get('email')]);
    }

    public function validatePhone(Request $request)
    {
        $path = '/check/validate-phone';
        return $this->moneyTrackRequest($path, ['phone' => $request->get('phone')]);
    }

    public function checkPhone(Request $request)
    {
        $path = '/check/phone';
        return $this->moneyTrackRequest($path, ['phone' => $request->get('phone')]);
    }

    public function checkCode(Request $request)
    {
        $path = '/check/code';
        return $this->moneyTrackRequest($path, ['code' => $request->get('code'), 'phone' => $request->get('phone')]);
    }

    public function getTrackParams()
    {
        return $this->getSessionData(array_keys($this->rules));
    }

    protected function getSessionData(array $data = array())
    {
        $result = array_filter(request()->session()->all(), function ($v, $k) use ($data) {
            return $data ? (in_array($k, $data)) : true;
        }, ARRAY_FILTER_USE_BOTH);

        return $result;
    }

    protected function getValueSessionData(string $data)
    {
        return current($this->getSessionData((array)$data));
    }

    protected function setSessionData(array $data = array())
    {
        session()->put($data ?: request()->all());
    }

    protected function setTransactionId()
    {
        if (!$this->getSessionData(['transaction_id'])) {
            $this->setSessionData(['transaction_id' => $this->getTransactionIdFormRequest()]);
        };
    }

    /**
     * @param null $ip
     * @return GeoIP
     */

    protected function getLocation($ip = null): GeoIP
    {
        return app('geoip')->getLocation($ip);
    }

    public function getSubscriberInfo()
    {

        $request = request();

        $data = function () use ($request) {
            return [
                'http_errors' => false,
                'form_params' => [
                    'geo' => $this->getGeoCountry(),
                    'user_agent' => $request->userAgent(),
                    'domain_name' => $request->getSchemeAndHttpHost(),
                    'id' => $this->getValueSessionData('subscriber_push_id'),
                    'tag' => $request->get('tag','lead')
                ]
            ];
        };


        $response = $this->sendFormRequest('http://pushmaze.loc.com/api/subscriber_info', $data)->getBody()->getContents();
        $this->setSessionData(['subscriber_push_id' => json_decode($response)->id]);
        return $response;
    }

}