<?php
/**
 * Milkman MilkmanInterface.
 * @category  Beverage
 * @package   Beverage_Milkman
 * @author    Beverage
 * @copyright Copyright (c) 2010-2017 Beverage Software Private Limited (https://Beverage.com)
 * @license   https://store.Beverage.com/license.html
 */

namespace Beverage\Milkman\Api\Data;

interface MilkmanInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const M_ID = 'm_id';
    const CATEGORY_ID = 'category_id';
    const ZIP_CODE = 'zip_code';
   

   /**
    * Get mId.
    *
    * @return int
    */
    function getMId();

   /**
    * Set mId.
    */
    function setMId($mId);

   /**
    * Get category id.
    *
    * @return varchar
    */
    function getCategoryId();

   /**
    * Set category id.
    */
    function setCategoryId($categoryId);

   /**
    * Get zipcode.
    *
    * @return varchar
    */
    function getZipCode();

   /**
    * Set zipcode.
    */
    function setZipCode($zipCode);
  
}
