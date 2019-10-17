<?php
/**
 * Grid Record Index Controller.
 * @category  Beverage
 * @package   Beverage_Milkman
 * @author    Beverage
 * @copyright Copyright (c) 2010-2017 Beverage Software Private Limited (https://Beverage.com)
 * @license   https://store.Beverage.com/license.html
 */
namespace Beverage\Milkman\Controller\Adminhtml\Milkman;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Mapped eBay Order List page.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Beverage_Milkman::milkman_list');
        $resultPage->getConfig()->getTitle()->prepend(__('Milkman List'));
        return $resultPage;
    }

    /**
     * Check Order Import Permission.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Beverage_Milkman::milkman_list');
    }
}
