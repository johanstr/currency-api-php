<?php

@require_once('app/apifunctions.php');

$cmd = 'ALL';

if(isset($_GET['cmd'])) {
    $cmd = strtoupper($_GET['cmd']);
}

switch($cmd) {
    case 'ALL':
        getAllCurrencies();
        break;

    case 'ONE':

        break;

    case 'CALC':
        $from = $_GET['from'];
        $value = $_GET['value'];
        $to = $_GET['to'];
        calculate($from, $value, $to);
        break;

    default:
        // Foutmeldingen genereren en teruggeven aan de caller
}