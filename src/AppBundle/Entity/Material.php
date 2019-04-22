<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Material
 *
 * @ORM\Table(name="material")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MaterialRepository")
 */
class Material
{
    /**
     * @var int
     *
     * @ORM\Column(name="material_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $materialId;

    /**
     * @var string
     *
     * @ORM\Column(name="material_name", type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner un nom")
     */
    private $materialName;

    /**
     * @var float
     *
     * @ORM\Column(name="material_price", type="float")
     * @Assert\GreaterThan(
     *  value = 0,
     *  message = "Le prix doit être supérieur à zéro"
     * )
     * @Assert\NotBlank(message="Veuillez renseigner un prix")
     */
    private $materialPrice;

    /**
     * @var int
     *
     * @ORM\Column(name="material_quantity", type="integer")
     * @Assert\GreaterThanOrEqual(
     *  value = 0,
     *  message = "La quantité ne peut être inférieure à zéro"
     * )
     * @Assert\NotBlank(message="Veuillez renseigner une quantité")
     */
    private $materialQuantity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="material_created_at", type="datetime")
     */
    private $materialCreatedAt;

    /**
     * Set materialId
     *
     * @param integer $materialId
     *
     * @return Material
     */
    public function setMaterialId($materialId)
    {
        $this->materialId = $materialId;

        return $this;
    }

    /**
     * Get materialId
     *
     * @return int
     */
    public function getMaterialId()
    {
        return $this->materialId;
    }

    /**
     * Set materialName
     *
     * @param string $materialName
     *
     * @return Material
     */
    public function setMaterialName($materialName)
    {
        $this->materialName = $materialName;

        return $this;
    }

    /**
     * Get materialName
     *
     * @return string
     */
    public function getMaterialName()
    {
        return $this->materialName;
    }

    /**
     * Set materialPrice
     *
     * @param float $materialPrice
     *
     * @return Material
     */
    public function setMaterialPrice($materialPrice)
    {
        $this->materialPrice = $materialPrice;

        return $this;
    }

    /**
     * Get materialPrice
     *
     * @return float
     */
    public function getMaterialPrice()
    {
        return $this->materialPrice;
    }

    /**
     * Set materialQuantity
     *
     * @param integer $materialQuantity
     *
     * @return Material
     */
    public function setMaterialQuantity($materialQuantity)
    {
        $this->materialQuantity = $materialQuantity;

        return $this;
    }

    /**
     * Get materialQuantity
     *
     * @return int
     */
    public function getMaterialQuantity()
    {
        return $this->materialQuantity;
    }

    /**
     * Set materialCreatedAt
     *
     * @param \DateTime $materialCreatedAt
     *
     * @return Material
     */
    public function setMaterialCreatedAt($materialCreatedAt)
    {
        $this->materialCreatedAt = $materialCreatedAt;

        return $this;
    }

    /**
     * Get materialCreatedAt
     *
     * @return \DateTime
     */
    public function getMaterialCreatedAt()
    {
        return $this->materialCreatedAt;
    }
}

