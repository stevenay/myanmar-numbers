<?php

namespace SteveNay\MyanmarMoneyText;

class MyanmarMoney
{
    public static function engNumberToMyanmarText(int $approveAmount = 0): string
    {
        $myanmarNumber = [
            'တစျ' => '1',
            'နှစျ' => '2',
            'သုံး' => '3',
            'လေး' => '4',
            'ငါး' => '5',
            'ခွောကျ' => '6',
            'ခုနစျ' => '7',
            'ရှစျ' => '8',
            'ကိုး' => '9',
        ];

        if ($approveAmount != 0) {
            $amountNumber = (string)$approveAmount;
            $result = $amountNumber;

            if (strlen($amountNumber) < 5): // for less then lah | no need to convert now
                return $amountNumber;
            elseif (strlen($amountNumber) === 5): // for less then lah | no need to convert now
                $amountFirstNumber = array_search($amountNumber[0], $myanmarNumber);
                if ($amountNumber[1] != 0):
                    $amountSecondDigit = array_search($amountNumber[1], $myanmarNumber);
                    return $amountFirstNumber . 'သောငျး' . $amountSecondDigit . 'ထောငျ';
                else:
                    return $amountFirstNumber . 'သောငျး';
                endif;
            elseif (strlen($amountNumber) === 6): // for သိန်း
                $amountFirstNumber = array_search($amountNumber[0], $myanmarNumber);
                if ($amountNumber[1] != 0):
                    $amountSecondDigit = array_search($amountNumber[1], $myanmarNumber);

                    $result = $amountFirstNumber . 'သိနျး' . $amountSecondDigit . 'သောငျး';
                    if ($amountNumber[2] !== '0') {
                        $amountThirdDigit = array_search($amountNumber[2], $myanmarNumber);
                        $result .= $amountThirdDigit . 'ထောငျ';
                    }
                    return $result;
                else:
                    return $amountFirstNumber . 'သိနျး';
                endif;

            elseif (strlen($amountNumber) === 7): // for သန်း
                $amountFirstNumber = array_search($amountNumber[0], $myanmarNumber);
                if ($amountNumber[0] == '1' && $amountNumber[1] == '0'):
                    return 'ဆယျသိနျး';
                endif;

                if ($amountNumber[1] != 0):
                    $myanmarNumber1 = array_search($amountNumber[1], $myanmarNumber);
                    return $amountFirstNumber . 'ဆယျ့' . $myanmarNumber1 . 'သိနျး';
                else:
                    return 'သိနျး' . $amountFirstNumber . 'ဆယျ';
                endif;
            elseif (strlen($amountNumber) === 8): // for ကုဋ
                $amountFirstNumber = array_search($amountNumber[0], $myanmarNumber);
                if ($amountNumber[0] == '1' && $amountNumber[1] == '0'):
                    return 'သိနျးတစျရာ';
                endif;

                if ($amountNumber[1] != 0):
                    $myanmarNumber1 = array_search($amountNumber[1], $myanmarNumber);
                    return 'သိနျး' . $amountFirstNumber . 'ရာ' . $myanmarNumber1 . 'ဆယျ့';
                else:
                    return 'သိနျး' . $amountFirstNumber . 'ရာ';
                endif;
            else: // 100 သိန်း range. Don't calculate 101 or 155 for now. Let's just assume all will end in 0
                return $amountNumber;
            endif;
        } else {
            return $approveAmount;
        }

    }
}