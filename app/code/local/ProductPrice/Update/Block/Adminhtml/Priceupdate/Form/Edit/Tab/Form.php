<?php
/**
 * Created by PhpStorm.
 * User: codilar
 * Date: 11/1/19
 * Time: 10:44 AM
 */
class ProductPrice_Update_Block_Adminhtml_Priceupdate_Form_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(
            array(
                'id' => 'update_form',
                'action' => $this->getUrl('*/*/update', array('id' => $this->getRequest()->getParam('order_id'))),
                'method' => 'post',
                'enctype' => 'multipart/form-data'
            )
        );

        $this->setForm($form);
        $fieldset = $form->addFieldset('update_form', array('legend'=>Mage::helper('priceupdate')->__('Price Update')));


//        $fieldset->addField('form_key', 'hidden', array(
//            //'label' => Mage::helper('listadmin_book')->__('Email'),
//            //'class' => 'required-entry',
//            'required' => true,
//            'value' => Mage::getSingleton('core/session')->getFormKey(),
//            'name' => 'form_key',
//        ));

        $fieldset->addField('catagories', 'select', array(
            'label' => Mage::helper('priceupdate')->__('Categories'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'catagories',
            'value' => '',
            'values' => Mage::registry('category_prodcount'),

        ));

        $fieldset->addField('price', 'text', array(
            'label'     => Mage::helper('priceupdate')->__('Price'),
            'class'     => 'validate-number required-entry',
            //'required'  => true,
            'min'       => '1',
            'max'       => '100',
            'name'      => 'price',
        ));

        $fieldset->addField('save', 'submit', array(
            //'label'     => Mage::helper('customorder')->__('Update'),
            'class'     => 'form-button',
            //'required'  => true,
            'name'      => 'update',
            'value'     => 'Update',
            'onclick' => "edit.submit();",
        ));

        $form->setUseContainer(true);
        $this->setForm($form);

        //Mage::registry('category_prodcount')
        //$this->setTemplate('customorder/view.phtml');
        return parent::_prepareForm();
    }
}