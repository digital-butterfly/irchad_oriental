<?php

function calculateIncomeTax($income) {
    $tax = 0;
    if ($income <= 30000) {
        $tax = 0;
    } elseif ($income <= 50000) {
        $tax = ($income * 0.1) - 3000;
    } elseif ($income <= 60000) {
        $tax = ($income * 0.2) - 8000;
    } elseif ($income <= 80000) {
        $tax = ($income * 0.3) - 14000;
    } elseif ($income <= 180000) {
        $tax = ($income * 0.34) - 17200;
    } else {
        $tax = ($income * 0.38) - 24400;
    }
    return $tax;
}
