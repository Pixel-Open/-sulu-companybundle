<?php

namespace Pixel\CompanyBundle\Twig;

use Doctrine\ORM\EntityManagerInterface;
use Pixel\CompanyBundle\Entity\Setting;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SettingsExtension extends AbstractExtension
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction("company_settings", [$this, "companySettings"])
        ];
    }

    public function companySettings()
    {
        return $this->entityManager->getRepository(Setting::class)->findOneBy([]);
    }
}
