<?php

namespace Pixel\CompanyBundle\Service;

class OpeningHours
{
    /**
     * @param mixed $day
     */
    public function getDay($day): string
    {
        switch ($day) {
            case 1:
            case "monday": return "Lundi";
            case 2:
            case "tuesday": return "Mardi";
            case 3:
            case "wednesday": return "Mercredi";
            case 4:
            case "thursday": return "Jeudi";
            case 5:
            case "friday": return "Vendredi";
            case 6:
            case "saturday": return "Samedi";
            case 7:
            case "sunday": return "Dimanche";
            default: break;
        }
        return "Pas de jour correspondant";
    }
}
