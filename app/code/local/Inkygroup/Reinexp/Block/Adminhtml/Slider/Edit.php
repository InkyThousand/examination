<?php
/**
 * Created by PhpStorm.
 * User: Inky
 * Date: 28.11.2015
 * Time: 13:15
 */
class Inkygroup_Reinexp_Block_Adminhtml_Slider_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected function _construct()
    {
        $this->_blockGroup = 'inkygroup_reinexp';
        $this->_controller = 'adminhtml_slider';
    }

    public function getHeaderText()
    {
        $helper = Mage::helper('inkygroup_reinexp');
        $model = Mage::registry('slider_edit');

        if ($model->getId()) {
            return $helper->__("Edit Slider item '%s'", $this->escapeHtml($model->getTitle()));
        } else {
            return $helper->__("Add item for Slider");
        }
    }

}