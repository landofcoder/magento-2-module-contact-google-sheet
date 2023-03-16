<?php
namespace Lof\Contact2GoogleSheet\Model\ResourceModel;

class ContactForm  extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('contact_form', 'entity_id');
    }
}
