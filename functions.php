<?php 

function showMonth() {
    $month = date('n');

    $dateObj   = DateTime::createFromFormat('!m', $month);
    $monthName = $dateObj->format('F');

    return $monthName;
}
