<?php
namespace Jiva\Contact\Model\ResourceModel\Extension;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Jiva\Contact\Model\Extension', 'Jiva\Contact\Model\ResourceModel\Extension');
    }
}
