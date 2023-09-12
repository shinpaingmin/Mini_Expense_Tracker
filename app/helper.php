<?php

declare(strict_types = 1);      // strict mode

// format currency
function formatDollarAmount(float $amount): string {
    $isNegative = $amount < 0;

    $formattedAmount = ($isNegative ? '-' : '') . '$' . number_format(abs($amount), 2);     // eg. -$29.99

    return $formattedAmount;
}

// format date
function formatDate(string $date): string {
    return date('M j, Y', strtotime($date));        // change string to unix timestamp first, then format
}
?>