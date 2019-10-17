<?php
namespace Beverage\Milkman\Model\ResourceModel\Milkman;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	/**
	 * @var string
	 */
	protected $_idFieldName = 'm_id';
	/**
	 * Define resource model.
	 */
	protected function _construct()
	{
		$this->_init(
			'Beverage\Milkman\Model\Milkman',
			'Beverage\Milkman\Model\ResourceModel\Milkman'
		);
	}
}
