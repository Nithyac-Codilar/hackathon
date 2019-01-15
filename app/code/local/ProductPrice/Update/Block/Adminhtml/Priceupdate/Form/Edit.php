<?php
/**
 * Created by PhpStorm.
 * User: codilar
 * Date: 11/1/19
 * Time: 10:30 AM
 */
class ProductPrice_Update_Block_Adminhtml_Priceupdate_Form_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'priceupdate';
        $this->_controller = 'adminhtml_priceupdate_form';

        //$this->_updateButton('save', 'label', Mage::helper('priceupdate')->__('Save'));


        $this->removeButton('add');
        $this->removeButton('save');
        $this->removeButton('reset');
    }

    public function getHeaderText()
    {
        return Mage::helper('priceupdate')->__('Update Form');
    }
}