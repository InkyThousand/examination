<?php
$methods = array(
  array(
      'name'=>'Renault',
      'alt'=>'Renault',
      'imagefile'=>'1.jpg',
      'status'=>'1'
  ),
  array(
      'name'=>'Maserati',
      'alt'=>'Maserati',
      'imagefile'=>'2.jpg',
      'status'=>'1'
  ),
  array(
      'name'=>'Nissan',
      'alt'=>'Nissan',
      'imagefile'=>'3.jpg',
      'status'=>'1'
  ),
  array(
      'name'=>'Aston Martin',
      'alt'=>'Aston Martin',
      'imagefile'=>'4.jpg',
      'status'=>'0'
  )
);
foreach ($methods as $method) {
    Mage::getModel('inkygroup_reinexp/slider')
        ->setData($method)
        ->save();
}