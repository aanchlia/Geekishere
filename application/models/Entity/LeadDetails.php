<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LeadDetails
 *
 * @Table(name="lead_details")
 * @Entity
 */
class LeadDetails
{
    /**
     * @var integer
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @Column(name="property_id", type="string", length=256, nullable=false)
     */
    private $propertyId;

    /**
     * @var string
     *
     * @Column(name="name", type="string", length=32, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @Column(name="email_id", type="string", length=32, nullable=false)
     */
    private $emailId;

    /**
     * @var string
     *
     * @Column(name="phone", type="string", length=32, nullable=false)
     */
    private $phone;

    /**
     * @var string
     *
     * @Column(name="message", type="text", nullable=true)
     */
    private $message;

    /**
     * @var integer
     *
     * @Column(name="email_sent", type="integer", nullable=false)
     */
    private $emailSent;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set propertyId
     *
     * @param string $propertyId
     * @return LeadDetails
     */
    public function setPropertyId($propertyId)
    {
        $this->propertyId = $propertyId;
    
        return $this;
    }

    /**
     * Get propertyId
     *
     * @return string 
     */
    public function getPropertyId()
    {
        return $this->propertyId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return LeadDetails
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set emailId
     *
     * @param string $emailId
     * @return LeadDetails
     */
    public function setEmailId($emailId)
    {
        $this->emailId = $emailId;
    
        return $this;
    }

    /**
     * Get emailId
     *
     * @return string 
     */
    public function getEmailId()
    {
        return $this->emailId;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     * @return LeadDetails
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return integer 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return LeadDetails
     */
    public function setMessage($message)
    {
        $this->message = $message;
    
        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set emailSent
     *
     * @param integer $emailSent
     * @return LeadDetails
     */
    public function setEmailSent($emailSent)
    {
        $this->emailSent = $emailSent;

        return $this;
    }

    /**
     * Get emailSent
     *
     * @return integer
     */
    public function getEmailSent()
    {
        return $this->emailSent;
    }

}
