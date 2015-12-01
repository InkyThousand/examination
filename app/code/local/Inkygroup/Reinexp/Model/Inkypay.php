<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 01.12.2015
 * Time: 10:38
 */
class Inkygroup_Reinexp_Model_Inkypay extends Mage_Payment_Model_Method_Abstract
{
    protected $_code = 'inkygroup_payment';

    protected $_isInitializeNeeded      = true;
    protected $_canUseInternal          = false;
    protected $_canUseForMultishipping  = false;

    public function isAvailable($quote = null) {
        $isLoggedIn = Mage::helper('customer')->isLoggedIn();
        return parent::isAvailable($quote) && $isLoggedIn;
    }
}