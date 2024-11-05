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
     * @var array<mixed>|null
     */
    private ?array $address = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Expose()
     */
    private ?string $placeId = null;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Serializer\Expose()
     */
    private ?string $apiKey = null;

    /**
     * @ORM\Column(type="json", nullable=true)
     * @Serializer\Expose()
     * @var array<string>|null
     */
    private ?array $openingHours = null;

    /**
     * @ORM\Column(type="json", nullable=true)
     * @Serializer\Expose()
     * @var array<mixed>|null
     */
    private ?array $googleMyBusiness = null;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Serializer\Expose()
     */
    private ?bool $useGoogleHours = null;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Serializer\Expose()
     */
    private ?string $aboutHours = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getMobilePhoneNumber(): ?string
    {
        return $this->mobilePhoneNumber;
    }

    public function setMobilePhoneNumber(?string $mobilePhoneNumber): void
    {
        $this->mobilePhoneNumber = $mobilePhoneNumber;
    }

    /**
     * @return array<mixed>
     */
    public function getAddress(): array
    {
        return $this->address;
    }

    /**
     * @param array<mixed>|null $address
     */
    public function setAddress(?array $address): void
    {
        $this->address = $address;
    }

    public function getPlaceId(): ?string
    {
        return $this->placeId;
    }

    public function setPlaceId(?string $placeId): void
    {
        $this->placeId = $placeId;
    }

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function setApiKey(?string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return array<string>
     */
    public function getOpeningHours(): array
    {
        return $this->openingHours;
    }

    /**
     * @param array<string>|null $openingHours
     */
    public function setOpeningHours(?array $openingHours): void
    {
        $this->openingHours = $openingHours;
    }

    /**
     * @return array<mixed>|null
     */
    public function getGoogleMyBusiness(): ?array
    {
        return $this->googleMyBusiness;
    }

    /**
     * @param array<mixed>|null $googleMyBusiness
     */
    public function setGoogleMyBusiness(?array $googleMyBusiness): void
    {
        $this->googleMyBusiness = $googleMyBusiness;
    }

    public function getUseGoogleHours(): ?bool
    {
        return $this->useGoogleHours;
    }

    public function setUseGoogleHours(?bool $useGoogleHours): void
    {
        $this->useGoogleHours = $useGoogleHours;
    }

    public function getAboutHours(): ?string
    {
        return $this->aboutHours;
    }

    public function setAboutHours(?string $aboutHours): void
    {
        $this->aboutHours = $aboutHours;
    }
}
