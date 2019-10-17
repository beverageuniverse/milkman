<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Beverage\Milkman\Ui\Component\Listing\Milkman\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
/**
 * @api
 * @since 100.0.2
 */
class Categories extends \Magento\Ui\Component\Listing\Columns
{
  protected $userFactory;
  /**
   * @param ContextInterface $context
   * @param array $components
   * @param array $data
   * @param UiComponentFactory $uiComponentFactory
   */
    /*function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory, array $components = [], array $data = []) {
        $this->uiComponentFactory = $uiComponentFactory;
        parent::__construct($context, $components, $data);
    }*/
    function __construct(ContextInterface $context,array $components = [],array $data = [],UiComponentFactory $uiComponentFactory) {
        parent::__construct($context, $components, $data);
    }
     /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    function prepareDataSource(array $dataSource)
     {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                if ($item[$fieldName] != '') {
                    $adminName = $this->getCatName($item[$fieldName]);
                    $item[$fieldName] = $adminName;
                }
            }
        }
        return $dataSource;
     }
     /**
          * @param $catId
          * @return string
          */
         private function getCatName($catId)
         {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $categoryHelper = $objectManager->get('\Magento\Catalog\Helper\Category');
            $categories = $categoryHelper->getStoreCategories();
            foreach ($categories as $category) { 
              if($category->getId() == $catId)
              { 
                return $category->getName();
              }
            }
         }
}
