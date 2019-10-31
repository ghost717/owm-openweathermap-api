<?php
error_reporting(0);
/*
 * OpenWeatherMap-PHP-API — A PHP API to parse weather data from https://OpenWeatherMap.org.
 *
 * @license MIT
 *
 * Please see the LICENSE file distributed with this source code for further
 * information regarding copyright and licensing.
 *
 * Please visit the following links to read about the usage policies and the license of
 * OpenWeatherMap data before using this library:
 *
 * @see https://OpenWeatherMap.org/price
 * @see https://OpenWeatherMap.org/terms
 * @see https://OpenWeatherMap.org/appid
 */

use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\Exception as OWMException;
use Tuupola\Http\Factory\RequestFactory;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

require './vendor/autoload.php';
require_once __DIR__ . '/bootstrap.php';

class MyWeather extends OpenWeatherMap {

    function __construct($cityNames, $myApiKey) {
        $httpRequestFactory = new RequestFactory();
        $httpClient = GuzzleAdapter::createWithConfig([]);
        $this->owm = new OpenWeatherMap($myApiKey, $httpClient, $httpRequestFactory);
        
        $this->cityNames = explode(",",$cityNames);
        $this->getWeathers();
        $this->checkTemp();
        $this->checkWind();
        $this->checkHumidity();
        
    }

    function getWeathers(){
        foreach ($this->cityNames as $key => $value) {
            $weather = $this->owm->getWeather($value, 'metric', 'pl');

            $this->mydata[$key]['name'] = trim($value);
            $this->mydata[$key]['temp'] = $weather->temperature->getValue();
            $this->mydata[$key]['humidity'] = $weather->humidity->getValue();
            $this->mydata[$key]['wind'] = $weather->wind->speed->getValue();
            $this->mydata[$key]['scores'] = 0;
            $this->mydata[$key]['time'] = $weather->lastUpdate->format('Y-m-d H:i:s');
        }
    }

    function checkTemp(){
        usort($this->mydata, function($a,$b){
            $c = $b['temp'] - $a['temp'];
            $c .= $b['wind'] - $a['wind'];
            $c .= strcmp($a['humidity'],$b['humidity']);
            return $c;
        });

        foreach ($this->mydata as $key => $value) {
            $this->mydata[$key]['scores'] += (100 - 10 * (($key + 1) - 1)) * 0.6;
        }
    }

    function checkWind(){
        usort($this->mydata, function($a,$b){
            $c = $b['wind'] - $a['wind'];
            $c .= $b['temp'] - $a['temp'];
            $c .= strcmp($a['humidity'],$b['humidity']);
            return $c;
        });

        foreach ($this->mydata as $key => $value) {
            $this->mydata[$key]['scores'] += (100 - 10 * (($key + 1) - 1)) * 0.3;
        }
    }

    function checkHumidity(){
        usort($this->mydata, function($a,$b){
            $c = $b['humidity'] - $a['humidity'];
            $c .= $b['wind'] - $a['wind'];
            $c .= strcmp($a['temp'],$b['temp']);
            return $c;
        });

        foreach ($this->mydata as $key => $value) {
            $this->mydata[$key]['scores'] += (100 - 10 * (($key + 1) - 1)) * 0.1;
        }
    }


    
}
  
$weather = new MyWeather($_GET['city'], $myApiKey);



