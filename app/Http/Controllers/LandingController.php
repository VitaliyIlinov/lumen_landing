<?php

namespace App\Http\Controllers;

use App\Traits\formRequest;
use GeoIp2\Model\City;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LandingController extends Controller
{
    use formRequest;

    protected $location;

    protected $rules = [
        'first_name' => 'required|string|sometimes',
        'last_name' => 'required|string|sometimes',
        'email_address' => 'required|email|sometimes',
        'phone' => 'required|string|sometimes',
        'countryISO' => 'required|string|size:2|sometimes',
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
    ];

    protected $rulesMessage = [];

    public function __construct()
    {
        $this->location = $this->getLocation('176.115.100.111');
        $this->setCountryIso($this->location);
        $this->setSessionData(env('GET_TRACK_PARAMS') == 'clicks'
            ? $this->getBinomFormRequest()
            : request()->all());

    }

    public function safe(Request $request)
    {
        if (env('FRAUDFILTER') && $request->get('pageType')) {
            return $this->getMoneyPage();
        }
        return $this->getSavePage();
    }

    public function money()
    {
        return $this->getMoneyPage();
    }

    private function getMoneyPage()
    {
        if (view()->exists('money.index')) {
            return view('money.index', [
                'location' => $this->location,
                'request' => request()->all()
            ]);
        }
        return view('errors.404');
    }

    private function getSavePage()
    {
        if (view()->exists('safe.index')) {
            return view('safe.index', [
                'location' => $this->location,
                'request' => request()->all()
            ]);
        }
        return view('errors.404');
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

        if (!$this->getSessionData(['transaction_id'])) {
            $this->setSessionData(['transaction_id' => $this->getTransactionIdFormRequest()]);
        };

        $request->merge($this->getTrackParams());
        return $this->sendDataForm($request->except('pageType'));
    }

    public function test(Request $request)
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

    protected function getIpAddress()
    {
        return isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
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
        session()->put($data ?: request()->except('pageType'));
    }


    protected function getLocation($ip = null)
    {
        return app('geoip')->getLocation($ip);
    }

    protected function setCountryIso(City $geoIP)
    {
        $this->setSessionData(['countryISO' => strtolower($geoIP->country->isoCode)]);
    }
}