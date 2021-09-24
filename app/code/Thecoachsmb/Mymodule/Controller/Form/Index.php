<?php
 
namespace Thecoachsmb\Mymodule\Controller\Form;
 
class Index extends \Magento\Framework\App\Action\Action
 
{
    public function execute()
    {
            $this->_view->loadLayout();
            $this->_view->renderLayout();
    }
}
