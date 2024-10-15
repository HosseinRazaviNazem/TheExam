<?php

namespace App\Helpers;

class JalaliHelper
{
    public static function convertToJalali($gregorianDate)
    {
        if (!$gregorianDate) {
            return 'بدون تاریخ';
        }

        $timestamp = strtotime($gregorianDate);

        list($gYear, $gMonth, $gDay) = explode('-', date('Y-m-d', $timestamp));
        list($jYear, $jMonth, $jDay) = self::gregorianToJalali($gYear, $gMonth, $gDay);

        $jalaliDate = "$jYear/$jMonth/$jDay";

        return self::convertNumbersToPersian($jalaliDate);
    }

    private static function gregorianToJalali($gYear, $gMonth, $gDay)
    {
        $gDaysInMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        $jDaysInMonth = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);

        if ($gYear > 1600) {
            $jy = 979;
            $gy = $gYear - 1600;
        } else {
            $jy = 0;
            $gy = $gYear - 621;
        }

        $gm = $gMonth - 1;
        $gd = $gDay - 1;

        $gDayNo = 365 * $gy + floor(($gy + 3) / 4) - floor(($gy + 99) / 100) + floor(($gy + 399) / 400);
        for ($i = 0; $i < $gm; ++$i) {
            $gDayNo += $gDaysInMonth[$i];
        }

        $gDayNo += $gd;

        $jDayNo = $gDayNo - 79;

        $jNp = floor($jDayNo / 12053);
        $jDayNo %= 12053;

        $jy += 33 * $jNp + 4 * floor($jDayNo / 1461);
        $jDayNo %= 1461;

        if ($jDayNo >= 366) {
            $jy += floor(($jDayNo - 1) / 365);
            $jDayNo = ($jDayNo - 1) % 365;
        }

        for ($i = 0; $i < 11 && $jDayNo >= $jDaysInMonth[$i]; ++$i) {
            $jDayNo -= $jDaysInMonth[$i];
        }
        $jm = $i + 1;
        $jd = $jDayNo + 1;

        return array($jy, $jm, $jd);
    }

    // Function to convert English numbers to Persian numbers
    public static function convertNumbersToPersian($input)
    {
        $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($englishNumbers, $persianNumbers, $input);
    }
}
