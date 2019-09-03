<?php
$autoload = __DIR__.'/vendor/autoload.php';
if (!file_exists($autoload))
{
    exit("Need Composer!");
}
require $autoload;

use SteveNay\MyanmarMoneyText\MyanmarNumber;
use SteveNay\MyanmarMoneyText\MyanmarMoney;

//echo MyanmarNumber::convert("52 West World", "my");
echo MyanmarMoney::engNumberToMyanmarText(99111110);