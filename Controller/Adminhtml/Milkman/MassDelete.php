<?php
/**
 * Beverage Grid Record Delete Controller.
 * @category  Beverage
 * @package   Beverage_Milkman
 * @author    Beverage
 * @copyright Copyright (c) 2010-2017 Beverage Software Private Limited (https://Beverage.com)
 * @license   https://store.Beverage.com/license.html
 */
namespace Beverage\Milkman\Controller\Adminhtml\Milkman;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Beverage\Milkman\Model\Milkman;
use Beverage\Milkman\Model\ResourceModel\Milkman\CollectionFactory;
class MassDelete extends \Magento\Backend\App\Action
{ /**
     * Massactions filter.
     * @var Filter
     */
    protected $_filter;

    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * @param Context           $context
     * @param Filter            $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {

        $this->_filter = $filter;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $collection = $this->_filter->getCollection($this->_collectionFactory->create());
        $recordDeleted = 0;
        foreach ($collection->getItems() as $record) {
            $record->setId($record->getMId());
            $record->delete();
            $recordDeleted++;
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $recordDeleted));

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }

    /**
     * Check Category Map recode delete Permission.
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Beverage_Milkman::row_data_delete');
    }
}
