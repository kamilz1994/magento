<?php

class Kamil_Weather_WeatherController extends Mage_Core_Controller_Front_Action {    

    public function indexAction(){
    	$lastItem = Mage::getModel('weather/weathermodel')->getCollection()->getLastItem();

    	$data = array(
    		'temp' => $lastItem->temp,
    		'pressure' => $lastItem->pressure,
    		'wind' => $lastItem->wind,
    		'time' => $lastItem->date
    		);

		$this->loadLayout();
    	$block = $this->getLayout()->createBlock('weather/weatherblock')->setSomething($data);
    	$block->setTemplate('kamil_weather/weather.phtml');
    	$this->getLayout()->getBlock('content')->append($block);
    	$this->renderLayout();

    	
    }

    public function updateAction(){

     	$newData = Mage::getModel('weather/weathermodel');
     	$args = $newData->getWeather();
    	$nowtime = date("Y-m-d H:i:s");
        $date = date('Y-m-d H:i:s', strtotime($nowtime . ' + 120 minute'));
        $newData->date = $date;
    	$newData->setTemp($args['temp']);
    	$newData->setPressure($args['pressure']);
    	$newData->setWind($args['wind']);
    	$newData->save();

    	$this->getResponse()->clearHeaders()->setHeader('Content-type','application/json',true);
        $this->getResponse()->setBody(json_encode($args));
    }

}

?>