<?php
namespace Beverage\Milkman\Block;

use Magento\Framework\View\Element\Template\Context;

use Beverage\Milkman\Model\Milkman;
use Magento\Framework\View\Element\Template;
class Listing extends Template
{

	/**
	 * Catalog data
	 *
	 * @var Data
	 */
	protected $_catalogData = null;

	/**
	 * @param Context $context
	 * @param array $data
	 */
	function __construct(Context $context,Milkman $model,\Magento\Framework\Registry $category,\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory, \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory)
	{
		parent::__construct($context);
		$this->model=$model;
		$this->category=$category;
		$this->_productCollectionFactory = $productCollectionFactory;
		$this->_categoryCollectionFactory = $categoryCollectionFactory;
	}

	/**
	 * Preparing layout
	 *
	 * @return \Magento\Catalog\Block\Breadcrumbs
	 */
	protected function _prepareLayout()
	{
			return parent::_prepareLayout();
	}
	function getParentId()
	  {
		$c_id=$this->category->registry('current_category');
		$cc1=$c_id->getId();
		$catExist = array();
		$product1=$this->model->getCollection();
		foreach ($product1 as $key => $value) {
		  $catExist[$key]=$value->getCategoryId();
		}

	}

	function getAllCategory()
	{
		$allData = array();
		$cats=$this->model->getCollection();

		foreach ($cats as $key => $cat) {
		   $allData[$key]=$cat->getCategoryId();
		}
		return $allData;
	}
	function getCurrentCategory()
	{
	   return $this->category->registry('current_category');
	}
	function getCurrentProduct()
	{
	  return $this->category->registry('current_product');
	}
	function getproCategoryId()
	{
	  $p1=$this->getCurrentProduct();
	  $categoryIds = $p1->getCategoryIds();
	  return $categoryIds;
	}
	function getProductCollection()
	 {
	   $collection = $this->_productCollectionFactory->create();
	   $collection->addAttributeToSelect('*');
	   return $collection;
	}
	function getParentCategory()
	{
		if($this->getCurrentCategory()):
			if($this->getCurrentCategory()->getParentCategory()):
				$this->getCurrentCategory()->getParentCategory()->getId();
			endif;
		endif;
	}
	function getCategoryCollection()
	{
	   $collection = $this->_categoryCollectionFactory->create();
	   $collection->addAttributeToSelect('*');
	   return $collection;
	}
	function getLevel1Category(){
		 if($this->getCurrentCategory()){
			 if($this->getCurrentCategory()->getParentCategories()){
				 foreach ($this->getCurrentCategory()->getParentCategories() as $parent) {
					 if ($parent->getLevel() == 2) {
						 // reurns the level 1 category id;
						 return $parent->getId();
					 }
				 }
			 }
		 }
		 return null;
	 }
	 function getLevel2Category($cat_id)
	 {
		$categories = $this->getCategoryCollection()->addAttributeToFilter('entity_id', $cat_id);
		foreach ($categories as $category)
		{
		  foreach ($category->getParentCategories() as $pcategory) {
			if ($pcategory->getLevel() == 2)
			{
			  return $pcategory->getId();
			}
		  }
		}
		return null;
	}
}
