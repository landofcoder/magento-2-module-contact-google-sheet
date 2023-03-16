<?php

namespace Lof\Contact2GoogleSheet\Model\GoogleSheet;

use Lof\Contact2GoogleSheet\Api\ContactFormInterface;
use Lof\Contact2GoogleSheet\Api\Data\ContactFormDataInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Stdlib\DateTime;

class ContactForm implements ContactFormInterface
{
    /**
     * @var \Lof\Contact2GoogleSheet\Model\ResourceModel\ContactForm
     */
    private $contactForm;

    /**
     * @var Api
     */
    private $googleApi;

    /**
     * @var DateTime
     */
    private $dateTime;

    /**
     * @var \Lof\Contact2GoogleSheet\Model\ContactFormFactory
     */
    private $contactFormFactory;

    /**
     * @var \Lof\Contact2GoogleSheet\Helper\Data
     */
    private $helper;

    /**
     * ContactForm constructor.
     * @param \Lof\Contact2GoogleSheet\Model\ContactFormFactory $contactFormFactory
     * @param \Lof\Contact2GoogleSheet\Model\ResourceModel\ContactForm $contactForm
     * @param Api $googleApi
     * @param \Lof\Contact2GoogleSheet\Helper\Data $helper
     * @param DateTime $dateTime
     */
    public function __construct(
        \Lof\Contact2GoogleSheet\Model\ContactFormFactory $contactFormFactory,
        \Lof\Contact2GoogleSheet\Model\ResourceModel\ContactForm $contactForm,
        \Lof\Contact2GoogleSheet\Model\GoogleSheet\Api $googleApi,
        \Lof\Contact2GoogleSheet\Helper\Data $helper,
        DateTime $dateTime
    ) {
        $this->contactFormFactory = $contactFormFactory;
        $this->contactForm = $contactForm;
        $this->googleApi = $googleApi;
        $this->dateTime = $dateTime;
        $this->helper = $helper;
    }

    /**
     * @param ContactFormDataInterface $contact
     * @return false|mixed|string
     */
    public function save(ContactFormDataInterface $contact)
    {
        if (!empty($contact->getName()) && (!empty($contact->getPhone()) || !empty($contact->getEmail()))) {
            $gmt7time = date("Y-m-d H:i", strtotime('+7 hours'));
            $createdAt = $this->dateTime->formatDate($gmt7time);
            try {
                $contactFormData = $this->contactFormFactory->create();
                $contactFormData->setData("name", $contact->getName());
                $contactFormData->setData("phone", $contact->getPhone());
                $contactFormData->setData("email", $contact->getEmail());
                $contactFormData->setData("comment", $contact->getComment());
                $contactFormData->setData("tags", $contact->getTags());
                $result = $this->contactForm->save($contactFormData);
                if ($result) {
                    $this->appendGoogleSheet($contact, $createdAt);
                }
            } catch (\Exception $exception) {
                throw  new CouldNotSaveException(__($exception->getMessage()));
            }
        } else {
            throw new InputException(__("Please fill the information"));
        }
        return [];
    }

    /**
     * append google sheet
     *
     * @param ContactFormDataInterface $contact
     * @param string $createdAt
     */
    private function appendGoogleSheet($contact, $createdAt)
    {
        $row = [
            $contact->getName(),
            $contact->getPhone(),
            $contact->getEmail(),
            $contact->getComment(),
            $contact->getTags(),
            $createdAt,
        ];
        return $this->googleApi->append($row);
    }
}
