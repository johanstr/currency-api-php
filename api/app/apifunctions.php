<?php

@require_once('app/DBHelper.php');

function getAllCurrencies() {
    $db = new DBHelper();
    $db->query('SELECT * FROM currency')
    $rows_json = $db->getAll();

    return json_encode($rows_json);
}

function calculate($from_currency, $value, $to_currency) {
    $db = new DBHelper();
    $db->query('SELECT * FROM currency WHERE abbr = :abbr', [ ':abbr' => $from_currency ]);
    $from_currency_row = $db->get();

    $db->query('SELECT * FROM currency WHERE abbr = :abbr', [ ':abbr' => $to_currency ]);
    $to_currency_row = $db->get();
        
    $valueInEuros = floatval($value) / floatval($from_currency_row['value']);
    $valueInToCurrency = floatval($valueInEuros) * floatval($to_currency_row['value']);

    return json_encode([
        'calculated_value' => $valueInToCurrency,
        'from' => $from_currency,
        'amount' => $value,
        'to' => $to_currency
    ]);
}