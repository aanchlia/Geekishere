<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OwnerInfo
 *
 * @Table(name="owner_info")
 * @Entity
 */
class OwnerInfo
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
     * @Column(name="owner_name", type="string", length=64, nullable=false)
     */
    private $ownerName;

    /**
     * @var string
     *
     * @Column(name="email_id", type="string", length=64, nullable=false)
     */
    private $emailId;

    /**
     * @var integer
     *
     * @Column(name="phone", type="integer", nullable=false)
     */
    private $phone;

    /**
     * @var string
     *
     * @Column(name="type", type="string", length=64, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @Column(name="location", type="string", length=64, nullable=false)
     */
    private $location;

    /**
     * @var string
     *
     * @Column(name="BUA", type="string", length=64, nullable=true)
     */
    private $bua;

    /**
     * @var string
     *
     * @Column(name="carpet", type="string", length=64, nullable=true)
     */
    private $carpet;

    /**
     * @var string
     *
     * @Column(name="amenities", type="string", length=64, nullable=true)
     */
    private $amenities;

    /**
     * @var string
     *
     * @Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @Column(name="commonfloor_id", type="string", length=128, nullable=true)
     */
    private $commonfloorId;

    /**
     * @var string
     *
     * @Column(name="nintynineacres_id", type="string", length=128, nullable=true)
     */
    private $nintynineacresId;

    /**
     * @var string
     *
     * @Column(name="magicbricks_id", type="string", length=128, nullable=true)
     */
    private $magicbricksId;

    /**
     * @var string
     *
     * @Column(name="makaan_id", type="string", length=128, nullable=true)
     */
    private $makaanId;


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
     * Set ownerName
     *
     * @param string $ownerName
     * @return OwnerInfo
     */
    public function setOwnerName($ownerName)
    {
        $this->ownerName = $ownerName;
    
        return $this;
    }

    /**
     * Get ownerName
     *
     * @return string 
     */
    public function getOwnerName()
    {
        return $this->ownerName;
    }

    /**
     * Set emailId
     *
     * @param string $emailId
     * @return OwnerInfo
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
     * @return OwnerInfo
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
     * Set type
     *
     * @param string $type
     * @return OwnerInfo
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return OwnerInfo
     */
    public function setLocation($location)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set bua
     *
     * @param string $bua
     * @return OwnerInfo
     */
    public function setBua($bua)
    {
        $this->bua = $bua;
    
        return $this;
    }

    /**
     * Get bua
     *
     * @return string 
     */
    public function getBua()
    {
        return $this->bua;
    }

    /**
     * Set carpet
     *
     * @param string $carpet
     * @return OwnerInfo
     */
    public function setCarpet($carpet)
    {
        $this->carpet = $carpet;
    
        return $this;
    }

    /**
     * Get carpet
     *
     * @return string 
     */
    public function getCarpet()
    {
        return $this->carpet;
    }

    /**
     * Set amenities
     *
     * @param string $amenities
     * @return OwnerInfo
     */
    public function setAmenities($amenities)
    {
        $this->amenities = $amenities;
    
        return $this;
    }

    /**
     * Get amenities
     *
     * @return string 
     */
    public function getAmenities()
    {
        return $this->amenities;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return OwnerInfo
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set commonfloorId
     *
     * @param string $commonfloorId
     * @return OwnerInfo
     */
    public function setCommonfloorId($commonfloorId)
    {
        $this->commonfloorId = $commonfloorId;
    
        return $this;
    }

    /**
     * Get commonfloorId
     *
     * @return string 
     */
    public function getCommonfloorId()
    {
        return $this->commonfloorId;
    }

    /**
     * Set nintynineacresId
     *
     * @param string $nintynineacresId
     * @return OwnerInfo
     */
    public function setNintynineacresId($nintynineacresId)
    {
        $this->nintynineacresId = $nintynineacresId;
    
        return $this;
    }

    /**
     * Get nintynineacresId
     *
     * @return string 
     */
    public function getNintynineacresId()
    {
        return $this->nintynineacresId;
    }

    /**
     * Set magicbricksId
     *
     * @param string $magicbricksId
     * @return OwnerInfo
     */
    public function setMagicbricksId($magicbricksId)
    {
        $this->magicbricksId = $magicbricksId;
    
        return $this;
    }

    /**
     * Get magicbricksId
     *
     * @return string 
     */
    public function getMagicbricksId()
    {
        return $this->magicbricksId;
    }

    /**
     * Set makaanId
     *
     * @param string $makaanId
     * @return OwnerInfo
     */
    public function setMakaanId($makaanId)
    {
        $this->makaanId = $makaanId;
    
        return $this;
    }

    /**
     * Get makaanId
     *
     * @return string 
     */
    public function getMakaanId()
    {
        return $this->makaanId;
    }
}
