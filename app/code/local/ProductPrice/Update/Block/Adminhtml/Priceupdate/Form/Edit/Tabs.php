<?php
/**
 * Created by PhpStorm.
 * User: codilar
 * Date: 11/1/19
 * Time: 10:41 AM
 */
class ProductPrice_Update_Block_Adminhtml_Priceupdate_Form_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('update_tabs');
        $this->setDestElementId('update_price'); // this should be same as the form id define above
        $this->setTitle(Mage::helper('priceupdate')->__('Update Price Form'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('priceupdate')->__('Update Form'),
            'title'     => Mage::helper('priceupdate')->__('Update Form'),
            'content'   => $this->getLayout()->createBlock('priceupdate/adminhtml_priceupdate_form_edit_tab_form')->toHtml(),
        ));

        //$this->setTemplate('customorder/view.phtml');

        return parent::_beforeToHtml();
    }
}