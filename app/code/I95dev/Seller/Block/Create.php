<?php
namespace I95dev\Seller\Block;
class Create extends \Magento\Framework\View\Element\Template
{
	public function __construct(\Magento\Framework\View\Element\Template\Context $context,array $data = [])
	{
		parent::__construct($context,$data);
	}

	public function sayHello()
	{
		return __('Hello World');
	}
	public function getPostCollection(){
		$post = $this->_postFactory->create();
		return $post->getCollection();
	}

    public function getFormAction()
    {
        return $this->getUrl('seller/account/create', ['_secure' => true]);
    }
}
