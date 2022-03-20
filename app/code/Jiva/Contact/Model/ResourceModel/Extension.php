<?php
namespace Jiva\Contact\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Extension extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('custom_contact', 'id');
    }
}
