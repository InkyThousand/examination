<?php
/**
 * Created by PhpStorm.
 * User: Inky
 * Date: 29.11.2015
 * Time: 21:45
 */
class Inkygroup_Reinexp_Model_Inkycargo extends Mage_Shipping_Model_Carrier_Abstract implements Mage_Shipping_Model_Carrier_Interface
{

    protected $_code = 'inkygroup_reinexp';

    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {

        if (!Mage::getStoreConfig('carriers/'.$this->_code.'/active')) {
            return false;
        }

        $result = Mage::getModel('shipping/rate_result');
        $show = true;
        if($show){

            $method = Mage::getModel('shipping/rate_result_method');
            $method->setCarrier($this->_code);
            $method->setMethod($this->_code);
            $method->setCarrierTitle($this->getConfigData('title'));
            $method->setMethodTitle($this->getConfigData('name'));
            $method->setPrice($this->getConfigData('price'));
            $method->setCost($this->getConfigData('price'));
            $result->append($method);

        }else{
            $error = Mage::getModel('shipping/rate_result_error');
            $error->setCarrier($this->_code);
            $error->setCarrierTitle($this->getConfigData('name'));
            $error->setErrorMessage($this->getConfigData('specificerrmsg'));
            $result->append($error);
        }
        return $result;
    }
    public function getAllowedMethods()
    {
        return array('inkygroup_reinexp'=>$this->getConfigData('name'));
    }

    protected function _getDefaultRate()
    {
        $rate = Mage::getModel('shipping/rate_result_method');

        $rate->setCarrier($this->_code);
        $rate->setCarrierTitle($this->getConfigData('title'));
        $rate->setMethod($this->_code);
        $rate->setMethodTitle($this->getConfigData('name'));
        $rate->setPrice($this->getConfigData('price'));
        $rate->setCost(0);

        return $rate;
    }
}