<?php

namespace App\Http\Controllers;

use App\Exceptions\LogException;
use App\Traits\FormRequest;
use GeoIp2\Model\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;

class LandingController extends Controller
{
    use FormRequest;

    protected $location;

    protected $rules = [
        'firstName' => 'required|string',
        'lastName' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
        'country' => 'required|string|size:2',
        'ip' => 'required|sometimes',
        'aff_id' => 'required|string|sometimes',
        'affiliate_id' => 'required|string|sometimes',
        'aff_sub' => 'required|string|sometimes',
        'offer_id' => 'required|string|sometimes',
        'transaction_id' => 'required|string|sometimes',
        'plid' => 'required|string|sometimes',
        'tsid' => 'required|string|sometimes',
        'buid' => 'required|string|sometimes',
        'bcamp_id' => 'required|string|sometimes',
        'source_id' => 'required|string|sometimes',
        'registration' => 'required|sometimes',
        'redirectTarget' => 'required|in:deposit,platform,webpage|sometimes',
        'comment' => 'required|string|sometimes',
        'accessKey' => 'required|string|sometimes',
        'password' => 'required|string|sometimes',
        'referrer' => 'required|string|sometimes',
        'sourceId' => 'required|string|sometimes',
        'externalId' => 'required|string|sometimes',
        'custom' => 'required|string|sometimes',
    ];

    protected $rulesMessage = [];

    public function __construct()
    {
        $this->location = $this->getLocation('176.115.100.111');
        $this->setSessionData(env('GET_TRACK_PARAMS') == 'clicks'
            ? $this->getBinomFormRequest()
            : request()->all());
        $this->setTransactionId();
        $this->setCountry($this->location);
        $this->setIp($this->location);
    }

    public function page(Request $request)
    {
        if (session()->get('pageType')) {
            return $this->getMoneyPage();
        }
        return $this->getSafePage();
    }

    public function getMoneyPage()
    {
        if (View::exists('Public::money.index')) {
            return view('Public::money.index', [
                'location' => $this->location,
                'request' => request()->all()
            ]);
        }
        throw new LogException('Not found view money.index', 303);
    }

    public function getSafePage()
    {
        if (View::exists('Public::safe.index')) {
            return view('Public::safe.index', [
                'location' => $this->location,
                'request' => request()->all()
            ]);
        }
        throw new LogException('not found view safe.index', 303);
    }


    public function send(Request $request)
    {
        /*try {
            $this->validate($request, $this->rules, $this->rulesMessage);
        } catch (ValidationException $e) {
            return $this->redirectBackWithErrors($request, $e);
        }*/

        $this->validate($request, $this->rules, $this->rulesMessage);

        if (env('GET_TRACK_PARAMS') == 'conversions') {
            $this->setSessionData($this->getBinomFormRequest());
        }

        $this->setTransactionId();

        $request->merge($this->getTrackParams() + ['accessKey' => env('ACCESS_KEY')]);
        $response = $this->sendDataForm($request->all());
        return $response->getBody()->getContents();
    }

    public function test()
    {
        print_r($this->getTrackParams());
    }

    public function responsePhoneChecker(Request $request)
    {
        return $this->checkPhoneRequest()->getBody()->getContents();
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

    protected function setSessionData(array $data = array())
    {
        session()->put($data ?: request()->all());
    }


    protected function getLocation($ip = null)
    {
        return app('geoip')->getLocation($ip);
    }

    protected function setCountry(City $geoIP)
    {
        $this->setSessionData(['country' => strtolower($geoIP->country->isoCode)]);
    }

    protected function setTransactionId()
    {
        if (!$this->getSessionData(['transaction_id'])) {
            $this->setSessionData(['transaction_id' => $this->getTransactionIdFormRequest()]);
        };
    }

    protected function setIp(City $geoIP)
    {
        $this->setSessionData(['ip' => $geoIP->traits->ipAddress]);
    }

}