<?php
/**
 * Beverage_Milkman Status Options Model.
 * @category    Beverage
 * @author      Beverage Software Private Limited
 */
namespace Beverage\Milkman\Model;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    /**
     * Get Milkman row status type labels array.
     * @return array
     */
    function getOptionArray()
    {
        $options = ['1' => __('Enabled'),'0' => __('Disabled')];
        return $options;
    }

    /**
     * Get Milkman row status labels array with empty value for option element.
     *
     * @return array
     */
    function getAllOptions()
    {
        $res = $this->getOptions();
        array_unshift($res, ['value' => '', 'label' => '']);
        return $res;
    }

    /**
     * Get Milkman row type array for option element.
     * @return array
     */
    function getOptions()
    {
        $res = [];
        foreach ($this->getOptionArray() as $index => $value) {
            $res[] = ['value' => $index, 'label' => $value];
        }
        return $res;
    }

    /**
     * {@inheritdoc}
     */
    function toOptionArray()
    {
        return $this->getOptions();
    }
}
