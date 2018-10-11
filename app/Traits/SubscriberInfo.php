<?php

namespace App\Traits;


trait SubscriberInfo
{


    protected $userAgent;

    /**
     * @param mixed $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    /**
     * Get user browser.
     *
     * @return string
     */
    public function browser()
    {
        if (strpos($this->userAgent, 'Opera') || strpos($this->userAgent, 'OPR/')) {
            return 'Opera';
        } elseif (strpos($this->userAgent, 'Edge')) {
            return 'Edge';
        } elseif (strpos($this->userAgent, 'Chrome')) {
            return 'Chrome';
        } elseif (strpos($this->userAgent, 'Safari')) {
            return 'Safari';
        } elseif (strpos($this->userAgent, 'Firefox')) {
            return 'Firefox';
        } elseif (strpos($this->userAgent, 'MSIE') || strpos($this->userAgent, 'Trident/7')) {
            return 'Internet Explorer';
        }
        return 'unknown';
    }

    /**
     * Get user platform.
     *
     * @return string
     */
    public function platform()
    {
        if (preg_match('/linux/i', $this->userAgent)) {
            return 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $this->userAgent)) {
            return 'mac';
        } elseif (preg_match('/windows|win32/i', $this->userAgent)) {
            return 'windows';
        }
        return 'unknown';
    }

    /**
     * Check whether user has connected from a mobile device (tablet, etc).
     *
     * @return bool
     */
    public function isMobile()
    {
        $aMobileUA = array(
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile'
        );

        // Return true if mobile User Agent is detected.
        foreach ($aMobileUA as $sMobileKey => $sMobileOS) {
            if (preg_match($sMobileKey, $this->userAgent)) {
                return 'mobile';
            }
        }
        return 'desktop';
    }

}