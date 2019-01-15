<?php
/**
 * Created by PhpStorm.
 * User: codilar
 * Date: 11/1/19
 * Time: 9:58 AM
 */
class ProductPrice_Update_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $conn = Mage::getSingleton('core/resource')->getConnection('core_read');

        $productcate = Mage::getSingleton('core/resource')->getTableName('catalog/category_product');
            $select = $conn->select()
                ->from(
                    array('main_table' => $productcate),
                    array(new Zend_Db_Expr('COUNT(main_table.product_id)'))
                )
                ->where('main_table.category_id = 4');
        //$bind = array('category_id' => (int)$category->getId());
        $counts = $conn->fetchOne($select);

        $cate = Mage::getResourceModel('catalog/category_collection')
            ->setStore(Mage::app()->getStore())
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('url_key')
            //->addFieldToFilter('entity_id', array('in' => $pathIds))
            ->addFieldToFilter('is_active', 1)
            ->load()
            ->getItems();


        foreach ($cate as $item){
            $conn = Mage::getSingleton('core/resource')->getConnection('core_read');
            $productcate = Mage::getSingleton('core/resource')->getTableName('catalog/category_product');
            $select = $conn->select()
                ->from(
                    array('main_table' => $productcate),
                    array(new Zend_Db_Expr('COUNT(main_table.product_id)'))
                )
                ->where('main_table.category_id = :category_id');
            $bind = array('category_id' => (int)$item->getId());
            $counts = $conn->fetchOne($select, $bind);

            $item->setData('product_count',$counts);

            $categories_product[] = $item;
            //echo"<pre>";print_r($item);
        }//die();


        foreach ($categories_product as $cate_prod){
            $parentids[$cate_prod->getParentId()] = $cate_prod->getParentId();

            $newcatlist[$cate_prod->getParentId()][$cate_prod->getEntityId()] = $cate_prod->getName();

            //echo"<pre>";print_r($cate_prod);
            $categproduct[$cate_prod->getEntityId()] = $cate_prod->getParentId()."-".$cate_prod->getName();

        }

        //echo"<pre>";print_r($categproduct);die();
        Mage::register('category_prodcount', $categproduct);

        //die();
        $this->_title($this->__('Catalog'))->_title($this->__('Update Product Price'));

        $this->loadLayout()->_setActiveMenu('catalog/priceupdate');

        $this->_addContent($this->getLayout()->createBlock('priceupdate/adminhtml_priceupdate_form_edit'))
            ->_addLeft($this->getLayout()->createBlock('priceupdate/adminhtml_priceupdate_form_edit_tabs'));

        $this->renderLayout();
    }

    public function updateAction(){

        //echo"<pre>";print_r($this->getRequest()->getPost());die();
        if(!$this->getRequest()->getPost('price')){
            Mage::getSingleton('core/session')->addError('Fill the mandatory fields');
            $this->_redirect('priceupdate/adminhtml_index');
            return false;
        }

        $category = Mage::getModel('catalog/category')->load($this->getRequest()->getPost('catagories'));
        /* Load all child categories  */
        $child_cate = $category->getChildren();
        $getCollections = $category->getProductCollection()
            ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
            ->addAttributeToFilter('visibility', 4)
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('entity_id', array('neq' => $child_cate));
        $cateproitems = $getCollections;
        //echo"<pre>";print_r($getCollections);die();
        foreach ($cateproitems as $proitems){
            //echo"<pre>";print_r($proitems->getVisibility());die();
            if($proitems->getVisibility()) {
                $newprice = $this->getRequest()->getPost('price') + $proitems->getPrice();
                //echo $proitems->getPrice()."<br>";
                $proitems->setPrice($newprice);
                $proitems->save();
                Mage::getSingleton('core/session')->addSuccess('Price Updated for '.$proitems->getName());
                //$msg = 1;
            }else{
                //echo"Test";
                Mage::getSingleton('core/session')->addSuccess('Price can`t Updated for '.$proitems->getName());
                //$msg = 0;
            }
        }
        $this->_redirect('adminhtml/catalog_category');

    }
}