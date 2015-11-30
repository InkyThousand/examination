<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 27.11.2015
 * Time: 16:23
 */
class Inkygroup_Reinexp_Model_Resource_Slider_Collection extends  Mage_Core_Model_Resource_Db_Collection_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('inkygroup_reinexp/slider');
    }

}