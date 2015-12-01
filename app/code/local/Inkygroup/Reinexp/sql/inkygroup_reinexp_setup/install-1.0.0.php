<?php

$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('inkygroup_reinexp/slider'))
    ->addColumn(
        'slide_id',Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
            'identity' => true,
        ), 'Slide No.'
    )
    ->addColumn(
        'name', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
            'nullable'=>false,
        ), 'Name Slide'
    )
    ->addColumn(
        'alt', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
            'nullable'=>false,
        ), 'Alt of Image'
    )
    ->addColumn(
        'imagefile', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
            'nullable'=>false,
        ), 'Image file Name'
    )
    ->addColumn(
        'status', Varien_Db_Ddl_Table::TYPE_BOOLEAN, null, array(
            'nullable' => true,
            'default' => 1,
         ), 'Status'
    )
    ->setComment('Inkygroup First Blogpost Method Table - Maintains admin editable custom blog-post');
$installer->getConnection()->createTable($table);

/*Add attribute "Point" to Customer Grid */

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$entityTypeId     = $setup->getEntityTypeId('customer');
$attributeSetId   = $setup->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

$installer->addAttribute("customer", "point_customers",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "Customer Points",
    "input"    => "text",
    "source"   => "",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => "Customer Points"

));

$attribute = Mage::getSingleton("eav/config")->getAttribute("customer", "point_customers");

$setup->addAttributeToGroup(
    $entityTypeId,
    $attributeSetId,
    $attributeGroupId,
    'point_customers',
    '20'
);

$used_in_forms = array();

$used_in_forms[] = "adminhtml_customer";
$used_in_forms[] = "checkout_register";
$used_in_forms[] = "customer_account_create";
$used_in_forms[] = "customer_account_edit";
$used_in_forms[] = "adminhtml_checkout";

$attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
;
$attribute->save();



$installer->endSetup();