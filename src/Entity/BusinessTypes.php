<?php

namespace App\Entity;

use App\Repository\BusinessTypesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BusinessTypesRepository::class)
 */
class BusinessTypes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $businessType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $businessCategory;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBusinessType(): ?string
    {
        return $this->businessType;
    }

    public function setBusinessType(?string $businessType): self
    {
        $this->businessType = $businessType;

        return $this;
    }

    public function getBusinessCategory(): ?string
    {
        return $this->businessCategory;
    }

    public function setBusinessCategory(?string $businessCategory): self
    {
        $this->businessCategory = $businessCategory;

        return $this;
    }

}
