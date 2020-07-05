<?php

function getMonthIndex() {
    $monthIndex = date('n');

    return $monthIndex;
}

function getMonthName() {
    $monthIndex = getMonthIndex();
    $dateObj = DateTime::createFromFormat('!m', $monthIndex);
    return $monthName = $dateObj->format('F');
}

$monthCounter = 06;

$dateObj   = DateTime::createFromFormat('!m', $monthCounter);
$monthName = $dateObj->format('F');
$nextMonth = $dateObj->modify('+1 month')->format('F');
$prevMonth = $dateObj->modify('-1 month')->format('F');
