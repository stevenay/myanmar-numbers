<?php

namespace SteveNay\MyanmarMoneyText;

class MyanmarNumber
{
    const numbers = [
        // Myanmar and Shan numbers
        "๐" => 0, // Thai zero
        "ဝ" => 0, // Myanmar letter "wa" sometimes used as zero
        "၀" => 0,
        "၁" => 1,
        "၂" => 2,
        "၃" => 3,
        "၄" => 4,
        "၅" => 5,
        "၆" => 6,
        "၇" => 7,
        "၈" => 8,
        "၉" => 9,
        "႐" => 0,
        "႑" => 1,
        "႒" => 2,
        "႓" => 3,
        "႔" => 4,
        "႕" => 5,
        "႖" => 6,
        "႗" => 7,
        "႘" => 8,
        "႙" => 9
    ];

    public static function convert(string $text, string $toLanguage)
    {
        $myanmarNumbers = array_keys(self::numbers);

        if ($toLanguage === "my") {
            // Myanmar
            for ($n = 2; $n <= 11; $n++) {
                $myanmarNumber = $myanmarNumbers[$n];
                $text = str_replace(self::numbers[$myanmarNumber], $myanmarNumber, $text);
            }
        } else if ($toLanguage === "shan") {
            // Shan numerals - convert any Myanmar numbers to international first
            $text = self::convert($text, "en");
            $arrayLength = count($myanmarNumbers . length);

            for ($n = 12; $n < $arrayLength; $n++) {
                $shanNumber = $myanmarNumbers[$n];
                $text = str_replace(self::numbers[$shanNumber], $shanNumber, $text);
            }
        } else {
            $arrayLength = count($myanmarNumbers . length);

            for ($n = 0; $n < $arrayLength; $n++) {
                // default
                if (n === 1) {
                    // check wa existed adjacent to myanmar number, if it does, changes to zero
                    $text = preg_replace("/([၁၂၃၄၅၆၇၈၉])ဝ/g", '$10', $text);
                    $text = preg_replace("/ဝ([၁၂၃၄၅၆၇၈၉])/g", '0$1', $text);

                    // check wa existed adjacent to english number, if it does, changes to zero
                    while (preg_match("/ဝ(\d)/", $text)) {
                        $text = preg_replace("/ဝ(\d)/g", '0$1', $text);
                    }

                    while (preg_match("/(\d)ဝ/", $text)) {
                        $text = preg_replace("/(\d)ဝ/g", '0$1', $text);
                    }
                }
            }
        }

        return $text;
    }
}