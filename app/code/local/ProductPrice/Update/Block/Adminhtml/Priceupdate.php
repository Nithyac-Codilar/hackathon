<?php
/**
 * Created by PhpStorm.
 * User: codilar
 * Date: 11/1/19
 * Time: 10:27 AM
 */
class ProductPrice_Update_Block_Adminhtml_Priceupdate extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_priceupdate';
        $this->_blockGroup = 'priceupdate';
        $this->_headerText = Mage::helper('priceupdate')->__('Update Product Price');
        //$this->_addButtonLabel = Mage::helper('customorder')->__('Add Order');
        parent::__construct();
        $this->removeButton('add');
    }
    public function _beforeToHtml()
    {
        //$this->assign('createUrl', $this->getUrl('*/sales/new'));
        //$this->setChild('', $this->getLayout()->createBlock('adminhtml/priceupdate_grid'));
        return parent::_beforeToHtml();
    }
}