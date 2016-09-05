<?php

class Kamil_Weather_Model_Mysql4_Weathermodel_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {
    protected function _construct()
    {
            $this->_init('weather/weathermodel');
    }
}

?>