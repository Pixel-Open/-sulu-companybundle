<?php

namespace Pixel\CompanyBundle\Service;

class OpeningHours
{
    public function getDay($day)
    {
        switch($day){
            case 1;
            case "monday": return "Lundi"; break;
            case 2:
            case "tuesday": return "Mardi"; break;
            case 3:
            case "wednesday": return "Mercredi"; break;
            case 4:
            case "thursday": return "Jeudi"; break;
            case 5:
            case "friday": return "Vendredi"; break;
            case 6:
            case "saturday": return "Samedi"; break;
            case 7:
            case "sunday": return "Dimanche"; break;
            default: break;
        }
        return "Pas de jour correspondant";
    }
}
