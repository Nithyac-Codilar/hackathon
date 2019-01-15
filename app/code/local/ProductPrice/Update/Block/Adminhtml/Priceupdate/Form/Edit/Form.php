<?php
/**
 * Created by PhpStorm.
 * User: codilar
 * Date: 11/1/19
 * Time: 10:39 AM
 */
class ProductPrice_Update_Block_Adminhtml_Priceupdate_Form_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(
            array(
                'id' => 'update_price',
                'action' => $this->getUrl('*/*/update', array('id' => $this->getRequest()->getParam('order_id'))),
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            )
        );

        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}