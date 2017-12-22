<?php

require 'vendor/autoload.php';

global $_DATA;

$_DATA = [
  'key' => getenv('PHPLIVEX_KEY'),
  'secret' => getenv('PHPLIVEX_SECRET'),
  'valid-lwin' => getenv('PHPLIVEX_VALID_LWIN') ? getenv('PHPLIVEX_VALID_LWIN') : '100598920111200750',
  'valid-subaccount' => getenv('PHPLIVEX_VALID_SUBACCOUNT') ? getenv('PHPLIVEX_VALID_SUBACCOUNT') : 'Main',
  'valid-buyerref' => getenv('PHPLIVEX_VALID_BUYERREF') ? getenv('PHPLIVEX_VALID_BUYERREF') : 'nt-test'
];

foreach($_DATA as $K => $V) {
  if(!$V) {
    echo 'Missing environment variable ' . $K . ' ' . PHP_EOL;
  }
}
