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
    }

}
  
$weather = new MyWeather($_GET['city'], $myApiKey);



