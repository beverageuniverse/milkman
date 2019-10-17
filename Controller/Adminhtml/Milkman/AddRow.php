<?php
namespace Beverage\Milkman\Controller\Adminhtml\Milkman;

use Magento\Framework\Controller\ResultFactory;

class AddRow extends \Magento\Backend\App\Action
{
	/**
	 * @var \Magento\Framework\Registry
	 */
	private $coreRegistry;

	/**
	 * @var \Beverage\Milkman\Model\MilkmanFactory
	 */
	private $milkmanFactory;

	/**
	 * @param \Magento\Backend\App\Action\Context $context
	 * @param \Magento\Framework\Registry $coreRegistry,
	 * @param \Beverage\Milkman\Model\MilkmanFactory $milkmanFactory
	 */
	function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\Registry $coreRegistry,
		\Beverage\Milkman\Model\MilkmanFactory $milkmanFactory
	) {
		parent::__construct($context);
		$this->coreRegistry = $coreRegistry;
		$this->milkmanFactory = $milkmanFactory;
	}

	/**
	 * Mapped Milkman List page.
	 * @return \Magento\Backend\Model\View\Result\Page
	 */
	function execute()
	{
		$rowId = (int) $this->getRequest()->getParam('id');
		$rowData = $this->milkmanFactory->create();
		/** @var \Magento\Backend\Model\View\Result\Page $resultPage */
		if ($rowId) {
			$rowData = $rowData->load($rowId);
			$rowTitle = $rowData->getTitle();
			if (!$rowData->getMId()) {
				$this->messageManager->addError(__('Data no longer exist.'));
				$this->_redirect('milkman/milkman/rowdata');
				return;
			}
		}
		$this->coreRegistry->register('row_data', $rowData);
		$resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
		$title = $rowId ? __('Edit Data ').$rowTitle : __('Add Data');
		$resultPage->getConfig()->getTitle()->prepend($title);
		return $resultPage;
	}

	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Beverage_Milkman::add_row');
	}
}
