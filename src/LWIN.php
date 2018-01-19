<?php

namespace Conduit\LivEx;

class LWIN {

  public $isValid;
  public $vintage;
  public $caseSize;
  public $bottleVolume;
  public $lwin7;
  public $lwin;

  /**
   * Construct a LWIN object
   * @private
   * @param string $in The LWIN string
   */

  function __construct($in) {
    $this->isValid = false;

    $this->vintage = null;
    $this->caseSize = null;
    $this->bottleVolume = null;
    $this->lwin7 = null;
    $this->lwin = null;

    $this->set($in);
  }

  function set($in) {

    switch(strlen($in)) {

      case 18:
        $this->lwin7 = substr($in, 0, 7);
        $this->vintage = (int) substr($in, 7, 4);
        $this->caseSize = (int) substr($in, 11, 2);
        $this->bottleVolume = (int) substr($in, 13, 5);
        $this->isValid = true;
        break;

      case 16:
        $this->lwin7 = substr($in, 0, 7);
        $this->vintage = (int) substr($in, 7, 4);
        $this->bottleVolume = (int) substr($in, 11, 5);
        $this->isValid = true;
        break;

      case 11:
        $this->lwin7 = substr($in, 0, 7);
        $this->vintage = (int) substr($in, 7, 4);
        $this->isValid = true;
        break;

      case 7:
        $this->lwin7 = $in;
        $this->isValid = true;
        break;

      default:
        $this->isValid = false;
        break;

    }

    if($this->isValid)
      $this->lwin = $in;

  }


  function is18() {
    return $this->is16() && $this->caseSize !== null;
  }

  function is16() {
    return $this->is11() && $this->bottleVolume !== null;
  }

  function is11() {
    return $this->is7() && $this->vintage !== null;
  }

  function is7() {
    if(!$this->isValid)
      return false;

   return $this->lwin7 !== null;
  }


  function to18() {

    if(!$this->is18())
      return false;

    $out = (string) $this->lwin7;
    $out .= str_pad((string) $this->vintage, 4, "0", STR_PAD_LEFT);
    $out .= str_pad((string) $this->caseSize, 2, "0", STR_PAD_LEFT);
    $out .= str_pad((string) $this->bottleVolume, 5, "0", STR_PAD_LEFT);
    return $out;
  }

  function to16() {

    if(!$this->is16())
      return false;

    $out = (string) $this->lwin7;
    $out .= str_pad((string) $this->vintage, 4, "0", STR_PAD_LEFT);
    $out .= str_pad((string) $this->bottleVolume, 5, "0", STR_PAD_LEFT);
    return $out;

  }

  function to11() {

    if(!$this->is11())
      return false;

    $out = (string) $this->lwin7;
    $out .= str_pad((string) $this->vintage, 4, "0", STR_PAD_LEFT);
    return $out;

  }

  function to7() {

    if(!$this->is7())
      return false;

    return (string) $this->lwin7;
  }

}
