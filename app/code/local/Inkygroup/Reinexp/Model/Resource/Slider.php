<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 27.11.2015
 * Time: 16:22
 */
class Inkygroup_Reinexp_Model_Resource_Slider extends Mage_Core_Model_Resource_Db_Abstract
{

    public function _construct()
    {
        $this->_init('inkygroup_reinexp/slider', 'slide_id');
    }

}