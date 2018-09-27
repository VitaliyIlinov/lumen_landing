<?php

namespace App\Http\Controllers;

use App\Exceptions\LogException;
use App\Traits\FormRequest;
use CodeOrange\GeoIP\GeoIP;
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
        //$this->location = $this->getLocation('176.115.100.111');
        $this->setSessionData(env('GET_TRACK_PARAMS') == 'clicks'
            ? $this->getBinomFormRequest()
            : request()->all());
        $this->setTransactionId();
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
        return $this->sendDataFormTrack($request->all());
    }


    public function getGeoCountry()
    {
        $path = env('MONEY_MAKE_SERVER').'/geoip/';
        return $this->sendFormRequest( $path,null,null)->getBody()->getContents();
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
        return $this->moneyTrackRequest($path, ['code' => $request->get('code'),'phone'=>$request->get('phone')]);
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

    protected function setTransactionId()
    {
        if (!$this->getSessionData(['transaction_id'])) {
            $this->setSessionData(['transaction_id' => $this->getTransactionIdFormRequest()]);
        };
    }

    /**
     * Gets the client IP address.
     *
     * @return float
     */
    public function getClientIp() {
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } elseif (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = '127.0.0.1';
        }

        return $ipaddress;
    }

    /**
     * @param null $ip
     * @return GeoIP
     */

    protected function getLocation($ip = null) :GeoIP
    {
        return app('geoip')->getLocation($ip);
    }

}