<?php

namespace Pixel\CompanyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Sulu\Component\Persistence\Model\AuditableInterface;
use Sulu\Component\Persistence\Model\AuditableTrait;

/**
 * @ORM\Entity()
 * @ORM\Table(name="company_settings")
 * @Serializer\ExclusionPolicy("all")
 */
class Setting implements AuditableInterface
{
    use AuditableTrait;

    public const RESOURCE_KEY = "company_settings";
    public const FORM_KEY = "company_settings";
    public const SECURITY_CONTEXT = "company_settings.settings";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Expose()
     */
    private ?string $name = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Expose()
     */
    private ?string $email = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Expose()
     */
    private ?string $phoneNumber = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Expose()
     */
    private ?string $mobilePhoneNumber = null;

    /**
     * @ORM\Column(type="json", nullable=true)
     * @Serializer\Expose()
     */
    private ?array $address = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Expose()
     */
    private ?string $placeId = null;

    /**
     * @ORM\Column(type="json", nullable=true)
     * @Serializer\Expose()
     */
    private ?array $openingHours = null;

    /**
     * @ORM\Column(type="json", nullable=true)
     * @Serializer\Expose()
     */
    private ?array $googleMyBusiness = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string|null
     */
    public function getMobilePhoneNumber(): ?string
    {
        return $this->mobilePhoneNumber;
    }

    /**
     * @param string|null $mobilePhoneNumber
     */
    public function setMobilePhoneNumber(?string $mobilePhoneNumber): void
    {
        $this->mobilePhoneNumber = $mobilePhoneNumber;
    }

    /**
     * @return array
     */
    public function getAddress(): array
    {
        return $this->address;
    }

    /**
     * @param array $address
     */
    public function setAddress(array $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string|null
     */
    public function getPlaceId(): ?string
    {
        return $this->placeId;
    }

    /**
     * @param string|null $placeId
     */
    public function setPlaceId(?string $placeId): void
    {
        $this->placeId = $placeId;
    }

    /**
     * @return array
     */
    public function getOpeningHours(): array
    {
        return $this->openingHours;
    }

    /**
     * @param array $openingHours
     */
    public function setOpeningHours(?array $openingHours): void
    {
        $this->openingHours = $openingHours;
    }

    /**
     * @return array|null
     */
    public function getGoogleMyBusiness(): ?array
    {
        return $this->googleMyBusiness;
    }

    /**
     * @param array|null $googleMyBusiness
     */
    public function setGoogleMyBusiness(?array $googleMyBusiness): void
    {
        $this->googleMyBusiness = $googleMyBusiness;
    }
}
