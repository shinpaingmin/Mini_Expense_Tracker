<?php

declare(strict_types = 1);      // strict mode

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;     // root directory

// define all paths
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

// require/include all files from app path
require APP_PATH . 'App.php';
require APP_PATH . 'helper.php';

$files = getTransactionFiles(FILES_PATH);       // files array

$transactions = [];     // array to store all transactions

// loop all the files and merge all the results to store in the above array
foreach($files as $file) {
    $transactions = array_merge($transactions, getTransactions($file, 'extractTransactions'));
}

$totals = calculateTotals($transactions);       // return an array which stores netTotal, totalIncome, totalExpense

require VIEWS_PATH . 'transactions.php';        // require/include transaction file from views path

?>