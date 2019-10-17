<?php
namespace Beverage\Milkman\Model\ResourceModel;

/**
 * Grid Milkman mysql resource.
 */
class Milkman extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	/**
	 * @var string
	 */
	protected $_idFieldName = 'm_id';
	/**
	 * @var \Magento\Framework\Stdlib\DateTime\DateTime
	 */
	protected $_date;

	/**
	 * Construct.
	 *
	 * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
	 * @param \Magento\Framework\Stdlib\DateTime\DateTime       $date
	 * @param string|null                                       $resourcePrefix
	 */
	function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context,
		\Magento\Framework\Stdlib\DateTime\DateTime $date,
		$resourcePrefix = null
	) {
		parent::__construct($context, $resourcePrefix);
		$this->_date = $date;
	}

	/**
	 * Initialize resource model.
	 */
	protected function _construct()
	{
		$this->_init('milkman_zipcode', 'm_id');
	}
}
