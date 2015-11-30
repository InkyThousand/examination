<?php
/**
 * Created by PhpStorm.
 * User: Inky
 * Date: 28.11.2015
 * Time: 13:19
 */
class Inkygroup_Reinexp_Block_Adminhtml_Slider_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        $helper = Mage::helper('inkygroup_reinexp');
        $model = Mage::registry('slider_edit');

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('slide_id' => $this->getRequest()->getParam('slide_id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data',
        ));
        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset('edit_slide', array('legend' => $helper->__('Slider:')));

        $fieldset->addField('name', 'text', array(
            'label' => $helper->__('Name of Slider (text under image)'),
            'required' => true,
            'name' => 'name',
        ));

        $fieldset->addField('alt', 'text', array(
            'label' => $helper->__('Alt (its for seo-optimization)'),
            'required' => false,
            'name' => 'alt',
        ));

        $fieldset->addField('imagefile', 'image', array(
            'label' => $helper->__('Image'),
            'name' => 'imagefile',
        ));

        $fieldset->addField('status', 'select', array(
            'label' => $helper->__('Visibility'),
            'name' => 'status',
            'required'  => true,
            'values'    => array(
                array('label' => 'false', 'value' => 0),
                array('label' => 'true', 'value' => 1)
            )
        ));

        $formData = array_merge($model->getData(), array('imagefile' => $model->getImageUrl()));
        $form->setValues($formData);
        $form->setForm($form);

        return parent::_prepareForm();
    }

}