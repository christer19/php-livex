<?php

namespace Conduit\LivEx;
use Conduit\LivEx\Error;

/**
 * A parent class to manage HTTPS connections.
 */

class ConnectionV2 {

  private $pubKey, $secret, $endpoint;
  private $httpTimeout = 30;

  /**
   * Constructor
   * @private
   * @param string $key      Public key
   * @param string $secret   Secret (private) key
   * @param string $endpoint Full URI to applicable endpoint
   */

  function __construct($key, $secret, $endpoint) {
    $this->pubKey = $key;
    $this->secret = $secret;
    $this->endpoint = $endpoint;
  }

/**
 * Make a HTTP request using the Liv-Ex V2 JSON API. Sends auth in headers and post data as JSON encoded
 * @param string $uri    URI to be appended to endpoint
 * @param string $method HTTP method (GET/POST)
 * @param array $data   Data to be encoded and sent
 */

  function request($uri, $method = 'GET', $data = NULL) {

    // Normalise HTTP method to uppercase

    $method = strtoupper($method);

    // Make our full URI from endpoint and requested URI
    $ch = curl_init($this->endpoint . $uri);

    // If data was supplied, JSON encode it
    if($data !== NULL)
      $data = json_encode($data);

    // Set HTTP headers, taking into account

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json', 'CLIENT_KEY: ' . $this->pubKey, 'CLIENT_SECRET: ' . $this->secret, 'Content-Length: ' . $data === NULL || $method !== 'POST' ? 0 : strlen($data)));

    curl_setopt($ch, CURLOPT_HEADER, 0);

    if($method === 'POST') {
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    curl_setopt($ch, CURLOPT_TIMEOUT, $this->httpTimeout);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    $return = curl_exec($ch);
    $errors = curl_error($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if(!empty($errors))
      return new Error('N001', $errors, $return);

    if($code > 399) {
      return new Error('H' . (string) $code, 'HTTP error ' . (string) $code, $return);
    }

    try {
      $res = json_decode($return);
    } catch (Exception $e) {
      return new Error('C001', '', $return);
    }

    // Inspect JSON response for failures

    if(isset($res->error->error) && is_array($res->error->error) && count($res->error->error) > 0) {

      $errors = [];

      foreach($res->error->error as $I => $E) {

        $errors[] = new Error($E->code, $E->message, $return);

      }

      return $errors;

    }


    // Check wrap-encoded HTTP status (hmm... why not just send a HTTP status code!?)

    if(!isset($res->httpCode))
      return new Error('C002', '', $return);

    if($res->httpCode > 399) {
      return new Error('H' . (string) $res->httpCode, 'HTTP error ' . (string) $res->httpCode . ': ' . $res->message, $return);
    }

    return $res;

  }

  function __destroy() {

  }

}
