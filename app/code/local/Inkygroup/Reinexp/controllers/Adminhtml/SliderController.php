<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 27.11.2015
 * Time: 11:53
 */
class Inkygroup_Reinexp_Adminhtml_SliderController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout()->_setActiveMenu('reinexp');
        $contentBlock = $this->getLayout()->createBlock('inkygroup_reinexp/adminhtml_slider');
        $this->_addContent($contentBlock);
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = (int) $this->getRequest()->getParam('slide_id');
        Mage::register('slider_edit', Mage::getModel('inkygroup_reinexp/slider')->load($id));
        $this->loadLayout()->_setActiveMenu('reinexp');
        $this->_addContent($this->getLayout()->createBlock('inkygroup_reinexp/adminhtml_slider_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        $id = $this->getRequest()->getParam('slide_id');
        if ($data = $this->getRequest()->getPost()) {
            try {
                $helper = Mage::helper('inkygroup_reinexp');
                $model = Mage::getModel('inkygroup_reinexp/slider');

                $model->setData($data)->setId($id);
                if (!$model->getCreated()) {
                    $model->setCreated(now());
                }
                $model->save();
                $id = $model->getId();

                if (isset($_FILES['imagefile']['name']) && $_FILES['imagefile']['name'] != '') {
                    $uploader = new Varien_File_Uploader('imagefile');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg'));
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    $uploader->save($helper->getImagePath(), $id . '.jpg');

                    $model->setImagefile($id.'.jpg');
                    $model->save();
                } else {
                    if (isset($data['imagefile']['delete']) && $data['imagefile']['delete'] == 1) {
                        @unlink($helper->getImagePath($id));
                    }
                }

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Slider was added/saved successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'slide_id' => $id
                ));
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Unable to find item to save'));
        $this->_redirect('*/*/');

    }
    public function massDeleteAction()
    {
        $news = $this->getRequest()->getParam('slide_check', null);

        if (is_array($news) && sizeof($news) > 0) {
            try {
                foreach ($news as $id) {
                    Mage::getModel('inkygroup_reinexp/slider')->setId($id)->delete();
                }
                $this->_getSession()->addSuccess($this->__('Slides have been deleted (Total: %d)', sizeof($news)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select slide item for delete'));
        }
        $this->_redirect('*/*');
    }

}