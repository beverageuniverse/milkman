<?php
namespace Beverage\Milkman\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
class InstallSchema implements InstallSchemaInterface
{
	/**
	 * {@inheritdoc}
	 *
	 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
	 */
	function install(
		SchemaSetupInterface $setup,
		ModuleContextInterface $context
	) {
		$installer = $setup;

		$installer->startSetup();

		/*
		 * Create table 'Milkman'
		 */

		$table = $installer->getConnection()->newTable(
			$installer->getTable('milkman_zipcode')
		)->addColumn(
			'm_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['identity' => true, 'nullable' => false, 'primary' => true],
			'Milkman Record Id'
		)->addColumn(
			'category_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			11,
			['nullable' => false],
			'Category Id'
		)->addIndex(
			$installer->getIdxName(
				$installer->getTable('Milkman'),
				['category_id'],
				\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
			),
			['category_id'],
			['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
		)->addColumn(
			'zip_code',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			null,
			['nullable' => false],
			'Zip code'        
		)->setComment(
			'Row Data Table'
		);

		$installer->getConnection()->createTable($table);
		$installer->endSetup();
	}
}
