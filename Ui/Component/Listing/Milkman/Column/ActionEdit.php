<?php
/**
 * Grid Ui Component Action.
 * @category  Beverage
 * @package   Beverage_Freecase
 * @author    Beverage
 * @copyright Copyright (c) 2010-2017 Beverage Software Private Limited (https://Beverage.com)
 * @license   https://store.Beverage.com/license.html
 */
namespace Beverage\Milkman\Ui\Component\Listing\Milkman\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class ActionEdit extends Column
{
    /** Url path */
    const ROW_EDIT_URL = 'milkman/milkman/addrow';
    /** @var UrlInterface */
    protected $_urlBuilder;

    /**
     * @var string
     */
    private $_editUrl;

    /**
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface       $urlBuilder
     * @param array              $components
     * @param array              $data
     * @param string             $editUrl
     */
    function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::ROW_EDIT_URL
    ) {
        $this->_urlBuilder = $urlBuilder;
        $this->_editUrl = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source.
     *
     * @param array $dataSource
     *
     * @return array
     */
    function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['m_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->_urlBuilder->getUrl(
                            $this->_editUrl,
                            ['id' => $item['m_id']]
                        ),
                        'label' => __('Edit'),
                    ];
                }
            }
        }

        return $dataSource;
    }
}