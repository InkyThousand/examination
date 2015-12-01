<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 01.12.2015
 * Time: 11:20
 */
class Inkygroup_Reinexp_Model_Observer
{
    public function customerPoints($observer)
    {
        $event = $observer->getEvent();

        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            $customerData = Mage::getSingleton('customer/session')->getCustomer();
            $customerId = $customerData->getId();
            $paymentMethod = $event->getData('payment')->getData('method');
            $paymentExchangeRate = Mage::getStoreConfig('payment/inkygroup_payment/exchange_rates');

            $customerPoints = $customerData->getPointCustomers();
            $orderAmount = $observer->getPayment()->getOrder()->getData('grand_total');

            if ($paymentMethod == 'inkygroup_payment') {
                if ($customerPoints >= $orderAmount) {
                    $customerPointsUpdate = $customerPoints - round($orderAmount);
                    $customer = Mage::getModel('customer/customer')->load($customerId);
                    $customer->setPointCustomers($customerPointsUpdate)->save();
                } else {
                    Mage::throwException('Choose a different payment method');
                }
            } else {

                $customerPointsUpdate = $customerPoints + round($orderAmount/$paymentExchangeRate);
                $customer = Mage::getModel('customer/customer')->load($customerId);
                $customer->setWebsiteId(Mage::app()->getWebsite()->getId());
                $customer->setPointCustomers($customerPointsUpdate);
                $customer->save();
            }
        }


    }
}