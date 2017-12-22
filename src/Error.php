<?php

namespace Conduit\LivEx;

class Error {

  private $errorCode;
  private $errorType;
  private $errorDesc;
  private $errorSupp;

  private $codeMap = [
    'C' => 'API Connector',
    'N' => 'Network Layer',
    'R' => 'API Response',
    'E' => 'API Error',
    'V' => 'Validation',
    'H' => 'HTTP'
  ];

  private $descMap = [
    'N001' => 'Generic network layer error',
    'C001' => 'JSON response serialisation failed'
  ];

  function __construct($code, $description = '', $supp = '') {

    if($code === true)
      $this->errorCode = 0;
    else
      $this->errorCode = $code;

    $this->errorDesc = $description;

    if(!empty($supp))
      $this->errorSupp = $supp;

  }

  function pretty() {
    echo 'LivEx Error: ' . $this->errorCode . ' (' . $this->describe() . ') [' . $this->origin() . ']' . PHP_EOL;
  }

  function code() {
    return $this->errorCode;
  }

  function describe() {
    if(empty($this->errorDesc))
      if(isset($this->descMap[$this->errorCode]))
        return $this->descMap[$this->errorCode];
      else
        return 'Unknown Error';

    return $this->errorDesc;
  }

  function origin() {

    if(gettype($this->errorCode) === 'integer')
      return 'API Connector';

    if(gettype($this->errorCode) === 'string' && isset($this->codeMap[strtoupper($this->errorCode[0])]))
      return $this->codeMap[strtoupper($this->errorCode[0])];

    return 'API Connector';

  }

  function hasSupplimental() {
    return !empty($this->errorSupp);
  }

  function supplimental() {
    return $this->errorSupp;
  }

  static function isError($in) {

    if(is_array($in)) {
      foreach($in as $D) {
        if(@get_class($D) !== 'Conduit\LivEx\Error')
          return false;
      }
    }

    if(@get_class($in) !== 'Conduit\LivEx\Error')
      return false;

    return true;
  }

}
