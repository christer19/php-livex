<?php

namespace Conduit\LivEx\Logistics;
use Conduit\LivEx\Error;
use Conduit\LivEx\ConnectionV2;

final class CellarView2 extends ConnectionV2 {

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

  /**
   * Get all CellarView2 items
   * @return array |\Conduit\LivEx\Error An array of results if successful, or an Error object if failed.
   */

  function getAll() {
    $r = $this->request('logistics/v1/cellarView2');

    if(Error::isError($r)) {
      return $r;
    } else {
      return $r->cellarViews->cellarViews;
    }

  }

/**
 * Find specific Cellar View records
 * If all parameters are null, this is essentially the same as calling CellarView2::getAll();
 * @param  string $lwin       Optional. A valid LWIN7, LWIN11, L-WIN16 or LWIN18, NULL if disabled
 * @param  string $subAccount Optional find by sub account code, NULL if disabled
 * @param  string $buyerRef   Optional find by buyer ref, NULL if disabled
 * @return array|\Conduit\LivEx\Error An array of results if successful, or an Error object if failed.
 */

  function find($lwin = NULL, $subAccount = NULL, $buyerRef = NULL) {

    $data = [];

    if(!is_null($lwin)) {
      $data['lwin'] = $lwin;
    }

    if(!is_null($subAccount)) {
      $data['subAccount'] = $subAccount;
    }

    if(!is_null($buyerRef)) {
      $data['buyerRef'] = $buyerRef;
    }

    $r = $this->request('logistics/v1/cellarView2', 'POST', ['stockMovement' => $data]);

    if(Error::isError($r)) {
      return $r;
    } else {
      return $r->cellarViews->cellarViews;
    }

  }

/**
 * Helper function to find by LWIN
 * @param  string $lwin A valid LWIN7, LWIN11, L-WIN16 or LWIN18.
 * @return array|\Conduit\LivEx\Error An array of results if successful, or an Error object if failed.
 */

  function findByLwin($lwin) {
    return $this->find($lwin);
  }

/**
 * Helper function to find by sub account code
 * @param  string $subAccount Sub Account Code
 * @return array|\Conduit\LivEx\Error An array of results if successful, or an Error object if failed.
 */

  function findBySubAccount($subAccount) {
    return $this->find(NULL, $subAccount);
  }

  /**
 * Helper function to find by buyer reference
 * @param  string $buyerRef Buyer Ref
 * @return array|\Conduit\LivEx\Error An array of results if successful, or an Error object if failed.
 */

  function findByBuyerRef($buyerRef) {
    return $this->find(NULL, NULL, $buyerRef);
  }

}
