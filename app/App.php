<?php

declare(strict_types = 1);      // strict mode

// scan transaction file
function getTransactionFiles(string $dirPath): array {
    $files = [];        // empty array to add all the scanned files

    // stores files in an array
    foreach(scandir($dirPath) as $file) {
        if(is_dir($file)) {
            continue;       
        }

        $files[] = $dirPath . $file;        // Add elements to the array using the [] notation
    }

    return $files;
}

// read transaction file
function getTransactions(string $filename, ?callable $transactionHandler = null): array {
    // terminate the function if the file does not exist
    if (!file_exists($filename)) {
        trigger_error('FILE' . $filename . 'DOES NOT EXIST.', E_USER_ERROR);
    }

    $file = fopen($filename, 'r');      // read the file

    $transactions = [];     // empty array to add transactions

    fgetcsv($file);     // To remove first line

    // loop all the other lines
    while (($transaction = fgetcsv($file)) !== false) {
        // transactionHandler exists?
        if ($transactionHandler !== null) {
            $transaction = $transactionHandler($transaction);
        }

        $transactions[] = $transaction;
    }

    fclose($file);      // close the file

    return $transactions;

}

// extract transaction to modify 
function extractTransactions(array $transaction): array {
    [$date, $checkNumber, $description, $amount] = $transaction;        // destructure the incoming array

    $amount = (float) str_replace(['$', ','], '', $amount);     // modify transaction format

    return [
        'date' => $date,
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount' => (float) $amount
    ];
}

// calculate total 
function calculateTotals(array $transactions): array {
    $totals = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];

    foreach($transactions as $transaction) {
        $totals['netTotal'] += $transaction['amount'];

        if($transaction['amount'] >= 0) {
            $totals['totalIncome'] += $transaction['amount'];
        } else {
            $totals['totalExpense'] += $transaction['amount'];
        }
    }
    
    return $totals;
}
?>