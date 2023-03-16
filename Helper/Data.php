<?php
namespace Lof\Contact2GoogleSheet\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{

    const CONFIG_PATH_CONTACT_GOOGLE_API_ENABLED = 'Lof_contact2googlesheet/google_sheet_contact/enabled';
    const CONFIG_PATH_CONTACT_GOOGLE_API_CREDENTIALS = 'Lof_contact2googlesheet/google_sheet_contact/credentials';
    const CONFIG_PATH_CONTACT_GOOGLE_CONTACT_FORM_SHEET_ID = 'Lof_contact2googlesheet/google_sheet_contact/contact_sheet_id';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface|null
     */
    protected $_scopeConfig = null;

    /**
     * Data constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
        $this->_scopeConfig = $context->getScopeConfig();
    }


    /**
     * @param $path
     * @param string $scope
     * @param null $storeId
     * @return mixed
     */
    public function getConfigValueByPath(
        $path,
        $scope = \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE,
        $storeId = null
    ) {
        return $this->_scopeConfig->getValue(
            $path,
            $scope,
            $storeId
        );
    }

    /**
     * get is enabled
     *
     * @return bool
     */
    public function getIsEnabled()
    {
        return (bool)$this->getConfigValueByPath(self::CONFIG_PATH_CONTACT_GOOGLE_API_ENABLED);
    }

    /**
     * get credential
     *
     * @return mixed
     */
    public function getCredential()
    {
        $credential = $this->getConfigValueByPath(self::CONFIG_PATH_CONTACT_GOOGLE_API_CREDENTIALS);
        return @json_decode($credential, true);
    }

    /**
     * get contact form sheet id
     *
     * @return string|int
     */
    public function getContactFormSheetId()
    {
        return $this->getConfigValueByPath(self::CONFIG_PATH_CONTACT_GOOGLE_CONTACT_FORM_SHEET_ID);
    }

}
