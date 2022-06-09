<?php

namespace Pixel\CompanyBundle\Twig;

use Doctrine\ORM\EntityManagerInterface;
use Pixel\CompanyBundle\Entity\Setting;
use Pixel\CompanyBundle\Service\OpeningHours;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class SettingsExtension extends AbstractExtension
{
    private EntityManagerInterface $entityManager;
    private Environment $environment;

    public function __construct(EntityManagerInterface $entityManager, Environment $environment)
    {
        $this->entityManager = $entityManager;
        $this->environment = $environment;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction("company_settings", [$this, "companySettings"]),
            new TwigFunction("get_company_hours", [$this, "getCompanyHours"], ["is_safe" => ["html"]]),
            new TwigFunction("get_google_review", [$this, "getGoogleReview"])
        ];
    }

    public function companySettings()
    {
        return $this->entityManager->getRepository(Setting::class)->findOneBy([]);
    }

    public function getCompanyHours()
    {
        $setting = $this->entityManager->getRepository(Setting::class)->findOneBy([]);
        $useGoogleHours = $setting->getUseGoogleHours();
        $openingHours = [];
        $day = new OpeningHours();
        if($useGoogleHours === null || $useGoogleHours === false){
            $openingHoursTmp = $setting->getOpeningHours();
            foreach($openingHoursTmp as $hour){
                $openHour = substr($hour['openHour'], 0, 5);
                $closeHour = substr($hour['closeHour'], 0, 5);
                if(array_key_exists($hour['day'], $openingHours)){
                    $openingHours[$hour['day']]['hours'] .= " / " . $openHour . " - " . $closeHour;
                }else{
                    $openingHours[$hour['day']]['day'] = $day->getDay($hour['day']);
                    $openingHours[$hour['day']]['hours'] = $openHour . " - " . $closeHour;
                }
            }
        }else{
            $openingHoursTmp = $setting->getGoogleMyBusiness()['result']['opening_hours']['periods'];
            foreach($openingHoursTmp as $hour){
                if(array_key_exists($hour['open']['day'], $openingHours)){
                    $openingHours[$hour['open']['day']]['hours'] .= " / " . substr($hour['open']['time'], 0, 2) . ":" . substr($hour['open']['time'], 2, 2) . " - " . substr($hour['close']['time'], 0, 2) . ":" . substr($hour['close']['time'], 2, 2);
                }else{
                    $openingHours[$hour['open']['day']]['day'] = $day->getDay($hour['open']['day']);
                    $openingHours[$hour['open']['day']]['hours'] = substr($hour['open']['time'], 0, 2) . ":" . substr($hour['open']['time'], 2, 2) . " - " . substr($hour['close']['time'], 0, 2) . ":" . substr($hour['close']['time'], 2, 2);
                }
            }
        }
        return $this->environment->render("@Company/twig/hours.html.twig", ["openingHours" => $openingHours]);
    }

    public function getGoogleReview()
    {
        $setting = $this->entityManager->getRepository(Setting::class)->findOneBy([]);
        $googleMyBusiness = $setting->getGoogleMyBusiness();
        if($googleMyBusiness === null){
            return null;
        }
        return [
            'rating' => $googleMyBusiness['result']['rating'],
            'total_rating' => $googleMyBusiness['result']['user_ratings_total']
        ];
    }
}
