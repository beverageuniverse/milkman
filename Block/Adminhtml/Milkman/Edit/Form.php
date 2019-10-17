<?php
/**
 * Beverage_Grid Add New Row Form Admin Block.
 * @category    Beverage
 * @package     Beverage_Freecase
 * @author      Beverage Software Private Limited
 *
 */
namespace Beverage\Milkman\Block\Adminhtml\Milkman\Edit;

/**
 * Adminhtml Add New Row Form.
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context,
     * @param \Magento\Framework\Registry $registry,
     * @param \Magento\Framework\Data\FormFactory $formFactory,
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
     * @param \Beverage\Milkman\Model\Status $options,
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Beverage\Milkman\Model\Status $options,
        array $data = [],\Magento\Catalog\Helper\Category $categoryHelper) {
        $this->_options = $options;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
        $this->categoryHelper = $categoryHelper;
    }

    protected function getCategoryCollection()
    {
        $collection=$this->categoryHelper->getStoreCategories();
        $data_array=array();
        foreach($collection as $item) {
            $data_array[]=array('value'=>$item->getId(),'label'=>$item->getName());
      }
      return($data_array);
    }
    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            ['data' => [
                            'id' => 'edit_form',
                            'enctype' => 'multipart/form-data',
                            'action' => $this->getData('action'),
                            'method' => 'post'
                        ]
            ]
        );

        $form->setHtmlIdPrefix('casegrid_');

        if ($model->getMId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Row Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('m_id', 'hidden', ['name' => 'm_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Row Data'), 'class' => 'fieldset-wide']
            );
        }


        $fieldset->addField(
            'zip_code',
            'textarea',
            [
                'name' => 'zip_code',
                'label' => __('Zip Code'),
                'id' => 'zip_code',
                'title' => __('Zip Code'),
                'class' => 'required-entry',
                'rows' => 25, 
                'required' => true
            ]
        )->setAfterElementHtml('<span style="font-size: 12px;">Enter comma separated list of zip codes without space. eg. 10001,10002,10003 etc...</span>');

        $wysiwygConfig = $this->_wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);

        
        $fieldset->addField('category_id', 'select', array(
                'name'  => 'category_id',
                'label' => 'Category',
                'title'     => 'Category',
                'values'   => $this->getCategoryCollection(),
                'required'  => true
            ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
