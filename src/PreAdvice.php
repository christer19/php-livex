<?php

namespace Conduit\LivEx\Logistics;
use Conduit\LivEx\Error;
use Conduit\LivEx\ConnectionV2;

class PreAdvice extends ConnectionV2 {

 /**
   * Instanciate the class
   * @private
   * @param string $key      Liv-Ex Key
   * @param string $secret   Liv-Ex Secret
   * @param string $endpoint Either "DEV", "LIVE" or full URI to endpoint
   */

  function __construct($key, $secret, $endpoint = 'DEV') {

    switch(strtoupper($endpoint)) {
      case 'DEV':
        $endpoint = 'https://apistaging.liv-ex.com/';
        break;
      case 'LIVE':
        $endpoint = 'https://api.liv-ex.com/';
        break;
      default:
        break;
    }

    parent::__construct($key, $secret, $endpoint);
  }




}
