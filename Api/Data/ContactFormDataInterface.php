<?php

namespace Lof\Contact2GoogleSheet\Api\Data;

interface ContactFormDataInterface
{
    const NAME  = 'name';
    const PHONE  = 'phone';
    const EMAIL  = 'email';
    const COMMENT  = 'comment';
    const CREATED_AT = 'created_at';
    const TAGS = 'tags';
    const CUSTOMER_ID = 'customer_id';

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return ContactFormDataInterface
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getPhone();

    /**
     * @param string $phone
     * @return ContactFormDataInterface
     */
    public function setPhone($phone);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $email
     * @return ContactFormDataInterface
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getComment();

    /**
     * @param string $comment
     * @return ContactFormDataInterface
     */
    public function setComment($comment);

    /**
     * @return string
     */
    public function getCreatedAt();

    /**
     * @param string $createdAt
     * @return ContactFormDataInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * @return int
     */
    public function getCustomerId();

    /**
     * @param int $customerId
     * @return ContactFormDataInterface
     */
    public function setCustomerId($customerId);

    /**
     * @return string
     */
    public function getTags();

    /**
     * @param string $tags
     * @return ContactFormDataInterface
     */
    public function setTags($tags);
}
