<?php
/**
* Created by PhpStorm.
* User: pavel
* Date: 26.11.2015
* Time: 13:16
*/
class Inkygroup_Reinexp_Block_Adminhtml_Slider extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    protected function _construct()
    {
        parent::_construct();

        $helper = Mage::helper('inkygroup_reinexp');

        $this->_blockGroup = 'inkygroup_reinexp';
        $this->_controller = 'adminhtml_slider';

        $this->_headerText = $helper->__('Slider Management');
        $this->_addButtonLabel = $helper->__('Add Slider');
    }
}