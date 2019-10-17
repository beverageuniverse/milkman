<?php
namespace Beverage\Milkman\Controller\Adminhtml\Milkman;

class Save extends \Magento\Backend\App\Action
{
	/**
	 * @var \Beverage\Milkman\Model\MilkmanFactory
	 */
	var $milkmanFactory;

	/**
	 * @param \Magento\Backend\App\Action\Context $context
	 * @param \Beverage\Milkman\Model\MilkmanFactory $milkmanFactory
	 */
	function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Beverage\Milkman\Model\MilkmanFactory $milkmanFactory
	) {
		parent::__construct($context);
		$this->milkmanFactory = $milkmanFactory;
	}

	/**
	 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
	 * @SuppressWarnings(PHPMD.NPathComplexity)
	 */
	function execute()
	{
		$data = $this->getRequest()->getPostValue();
		if (!$data) {
			$this->_redirect('milkman/milkman/addrow');
			return;
		}
		try {
			$rowData = $this->milkmanFactory->create();
			$rowData->setData($data);
			if (isset($data['id'])) {
				$rowData->setMId($data['id']);
			}
			$rowData->save();
			$this->messageManager->addSuccess(__('Data has been successfully saved.'));
		} catch (\Exception $e) {
			$this->messageManager->addError(__($e->getMessage()));
		}
		$this->_redirect('milkman/milkman/index');
	}

	/**
	 * @return bool
	 */
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Beverage_Milkman::save');
	}
}
