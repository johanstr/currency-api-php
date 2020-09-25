<?php

@require_once('app/apifunctions.php');
@require_once('HttpStatus.php');

$cmd = 'ALL';
$response = null;

if(isset($_GET['cmd'])) {
    $cmd = strtoupper($_GET['cmd']);
}

switch($cmd) {
    case 'ALL':
        $response = getAllCurrencies();
        break;

    case 'ONE':

        break;

    case 'CALC':
        $from = $_GET['from'];
        $value = $_GET['value'];
        $to = $_GET['to'];
        $response = calculate($from, $value, $to);
        break;

    default:
        // Foutmeldingen genereren en teruggeven aan de caller
}

if($response !== null && !empty($response)) {
    http_return($response, 200);
}