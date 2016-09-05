<?php

class Kamil_Weather_Model_Mysql4_Weathermodel extends Mage_Core_Model_Mysql4_Abstract{
    protected function _construct()
    {
        $this->_init('weather/weathermodel');
    }  
}

?>