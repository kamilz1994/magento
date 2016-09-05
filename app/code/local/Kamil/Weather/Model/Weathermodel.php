<?php

class Kamil_Weather_Model_Weathermodel extends Mage_Core_Model_Abstract 
{
    protected function _construct()
    {
        $this->_init('weather/weathermodel');
    }  

    public function getWeather(){
    	$BASE_URL = "http://query.yahooapis.com/v1/public/yql";
    	$yql_query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="lublin") and u="f"';
    	$yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json";
    	$session = curl_init($yql_query_url);
    	curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
    	$json = curl_exec($session);
     	$phpObj =  json_decode($json);

     	$units=$phpObj->query->results->channel->wind;
     	$speed = $units->speed;
     	$units=$phpObj->query->results->channel->item->condition;
     	$temp = intval((5/9)*($units->temp-32));
     	$units=$phpObj->query->results->channel->atmosphere;
     	$pressure = $units->pressure;

     	$args = array(
     		'temp' => $temp,
     		'wind' => $speed,
     		'pressure' => $pressure,
     	);

     	return $args;
    } 
}

?>