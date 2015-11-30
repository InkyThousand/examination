<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 27.11.2015
 * Time: 11:04
 */
class Inkygroup_Reinexp_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getImagePath($id = 0)
    {
        $path = Mage::getBaseDir('media') . '/inkyslider';
        if ($id) {
            return "{$path}/{$id}.jpg";
        } else {
            return $path;
        }
    }

    public function getImageUrl($id = 0)
    {
        $url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'inkyslider/';
        if ($id) {
            return $url . $id . '.jpg';
        } else {
            return $url;
        }
    }
}