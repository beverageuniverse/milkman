<?php

/**
 * Grid Milkman Model.
 * @category  Beverage
 * @package   Beverage_Milkman
 * @author    Beverage
 * @copyright Copyright (c) 2010-2017 Beverage Software Private Limited (https://Beverage.com)
 * @license   https://store.Beverage.com/license.html
 */
namespace Beverage\Milkman\Model;

use Beverage\Milkman\Api\Data\MilkmanInterface;

class Milkman extends \Magento\Framework\Model\AbstractModel implements MilkmanInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'milkman_zipcode';

    /**
     * @var string
     */
    protected $_cacheTag = 'milkman_zipcode';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'milkman_zipcode';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('Beverage\Milkman\Model\ResourceModel\Milkman');
    }
    /**
     * Get MId.
     *
     * @return int
     */
    function getMId()
    {
        return $this->getData(self::M_ID);
    }
    /**
     * Set MId.
     */
    function setMId($mId)
    {
        return $this->setData(self::M_ID, $mId);
    }
    /**
     * Set CategoryId.
     */
    function setCategoryId($categoryId)
    {
        return $this->setData(self::CATEGORY_ID, $categoryId);
    }
    /**
     * Get CategoryId.
     *
     * @return int
     */
    function getCategoryId()
    {
        return $this->getData(self::CATEGORY_ID);
    }
    /**
     * Get Zipcode.
     *
     * @return varchar
     */
    function getZipCode()
    {
        return $this->getData(self::ZIP_CODE);
    }

    /**
     * Set Zipcode.
     */
    function setZipCode($zipCode)
    {
        return $this->setData(self::ZIP_CODE, $zipCode);
    }

   
}
