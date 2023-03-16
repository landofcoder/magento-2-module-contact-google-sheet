<?php
namespace Lof\Contact2GoogleSheet\Api;
use Lof\Contact2GoogleSheet\Api\Data\ContactFormDataInterface;

interface ContactFormInterface
{
    /**
     * @param ContactFormDataInterface $contact
     * @return mixed
     */
    public function save(ContactFormDataInterface $contact);
}

