<?php


namespace Mfpe\ConfigBundle\Services;


use Symfony\Component\Templating\EngineInterface;

class ConvertDate
{
    public function __construct()
    {
    }

    public function convertDate($date, $langue)
    {
        if ($langue == "ar") {
            $date = explode("-", $date);
            $day = $date[0];
            $month = intVal($date[1]);
            $year = $date[2];
            $months = array(
                1 => "جانفي",
                2 => "فيفري",
                3 => "مارس",
                4 => "أفريل",
                5 => "ماي",
                6 => "جوان",
                7 => "جويلية",
                8 => "أوت",
                9 => "سبتمبر",
                10 => "أكتوبر",
                11 => "نوفمبر",
                12 => "ديسمبر"
            );
            $dateConverted = $day . " " . $months[$month] . " " . $year;
        }
        return $dateConverted;
    }

}