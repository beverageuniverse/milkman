<?php
namespace Beverage\Milkman\Block\Adminhtml\Milkman;

use Magento\Framework\View\Element\Template\Context;
use Beverage\Milkman\Model\Milkman;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Data\Form\FormKey;

class Display extends Template
{
     protected $formKey;/*protected $authSession;*/
    public function __construct(Context $context, Milkman $model,array $data,FormKey $formKey)
    {
        $this->model = $model; // for getting model
        parent::__construct($context,$data);
        $this->formKey = $formKey;
    }
    public function getFormKey() //To get form key
    {
        return $this->formKey->getFormKey();
    }
    public function getMilkmanCollection()
    {
        $mCollection = $this->model->getCollection();
        return $mCollection;
    }
}