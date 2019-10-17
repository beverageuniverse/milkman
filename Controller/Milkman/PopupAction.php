<?php
namespace Beverage\Milkman\Controller\Milkman;

use Beverage\Milkman\Model\Milkman;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use Magento\Framework\Stdlib\Cookie\PublicCookieMetadata;
use Magento\Framework\Stdlib\CookieManagerInterface;

class PopupAction extends \Magento\Framework\App\Action\Action
{
  protected $resultPageFactory;
  function __construct(\Magento\Framework\App\Action\Context $context,Milkman $model,\Magento\Framework\Registry $category,CookieManagerInterface $cookieManager,CookieMetadataFactory $cookieMetadataFactory,SessionManagerInterface $sessionManager,\Magento\Framework\ObjectManagerInterface $objectManager)
  {
	parent::__construct($context);
	  $this->model = $model; // for getting model
	  $this->category=$category;
	  $this->_cookieManager = $cookieManager;
	  $this->_cookieMetadataFactory = $cookieMetadataFactory;
	  $this->_sessionManager = $sessionManager;
	  $this->_objectManager = $objectManager;      
  }

  function execute()
  {
	  $splitzip = array();
	  $Allcode = array();
	  $flag=false;
	  $allZip = array();
	  $rowId = (int) $this->getRequest()->getParam('id');
	  $cId= $this->getRequest()->getParam('cid');
	  $cats=$this->model->getCollection();

	  $Allcode=$this->model->getCollection()->addFieldToSelect("zip_code")->addFieldToFilter('category_id',['in' =>  $cId]);

	  foreach ($Allcode as $zip_code)
	  {
		  $allZip=$zip_code->getZipCode();
		  $splitzip=explode(',',$allZip);
		  if(in_array($rowId, $splitzip))
		  {
			  $flag=true;
			  $metadata = $this->_cookieMetadataFactory
				  ->createPublicCookieMetadata()
				  ->setDuration(86400)
				  ->setPath($this->_sessionManager->getCookiePath())
				  ->setDomain($this->_sessionManager->getCookieDomain());

			  $this->_cookieManager->setPublicCookie(
				  'popup_cookie',
				  true,
				  $metadata
			  );
			  $this->_cookieManager->setPublicCookie(
				  'zipcode',
				  $rowId,
				  $metadata
			  );
			  break;
		  }
	  }
	  die(json_encode(array('success'=>$flag)));
	}
}
?>