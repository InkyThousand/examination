<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 30.11.2015
 * Time: 11:52
 */
class Inkygroup_Reinexp_Block_Slider extends Mage_Core_Block_Template
{

    public function getSliderCollection(){
        $sliderCollection = Mage::getModel('inkygroup_reinexp/slider')->getCollection();
        $sliderCollection->setOrder('slide_id', 'ASC');
        return $sliderCollection;
    }
}