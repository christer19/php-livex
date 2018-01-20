<?php

use PHPUnit\Framework\TestCase;

final class LWINTest extends TestCase {

  public function testValidLwin18IsValid() {
    $l = new Conduit\LivEx\LWINType("100604520141200750");

    $this->assertEquals($l->isValid, true);
  }

  public function testValidLwin18IsAValidLwin16() {
    $l = new Conduit\LivEx\LWINType("100604520141200750");

    $this->assertEquals($l->is16(), true);
  }

  public function testValidLwin18IsAValidLwin11() {
    $l = new Conduit\LivEx\LWINType("100604520141200750");

    $this->assertEquals($l->is11(), true);
  }

  public function testValidLwin18IsAValidLwin7() {
    $l = new Conduit\LivEx\LWINType("100604520141200750");

    $this->assertEquals($l->is7(), true);
  }

  public function testValidLwin16IsValid() {
    $l = new Conduit\LivEx\LWINType("1006045201400750");

    $this->assertEquals($l->isValid, true);
  }

  public function testValidLwin11IsValid() {
    $l = new Conduit\LivEx\LWINType("10060452014");

    $this->assertEquals($l->isValid, true);
  }

  public function testValidLwin7IsValid() {
    $l = new Conduit\LivEx\LWINType("1006045");

    $this->assertEquals($l->isValid, true);
  }

  public function testInvalidLwinWith8NumbersIsNotValid() {
    $l = new Conduit\LivEx\LWINType("10060450"); // 8 long
    $this->assertEquals($l->isValid, false);
  }

  public function testInvalidLwinFooIsNotValid() {
    $l = new Conduit\LivEx\LWINType("foo"); // Alphanumeric foo
    $this->assertEquals($l->isValid, false);
  }

  public function testInvalidLwinWithAlphanumericCharsButCorrect18LengthIsNotValid() {
    $l = new Conduit\LivEx\LWINType("abdbc'esi#oirntk;y"); // Alphanumeric 18 chars...
    $this->assertEquals($l->isValid, false);
  }

  public function testInvalidLwinWith4NumbersIsNotValid() {
    $l = new Conduit\LivEx\LWINType("1006"); // 4 long
    $this->assertEquals($l->isValid, false);
  }

  public function testValidLwin7IsNotAValidLwin11() {
    $l = new Conduit\LivEx\LWINType("1006045");
    $this->assertEquals($l->is11(), false);
  }

  public function testValidLwin7IsNotAValidLwin16() {
    $l = new Conduit\LivEx\LWINType("1006045");
    $this->assertEquals($l->is16(), false);
  }

  public function testValidLwin7IsNotAValidLwin18() {
    $l = new Conduit\LivEx\LWINType("1006045");
    $this->assertEquals($l->is18(), false);
  }

  public function testValidLwin7IsAValidLwin7() {
    $l = new Conduit\LivEx\LWINType("1006045");
    $this->assertEquals($l->is7(), true);
  }

  public function testValidLwin7CanBeProgressivelyExtendedUpToLwin18BySettingProperties() {
    $l = new Conduit\LivEx\LWINType("1006045");
    $this->assertEquals($l->is7(), true);

    $l->vintage = 2015;

    $this->assertEquals($l->is11(), true);

    $l->bottleVolume = 750;

    $this->assertEquals($l->is16(), true);

    $l->caseSize = 6;

    $this->assertEquals($l->is18(), true);
  }

  public function testValidLwin7CanBeProgressivelyExtendedUpToLwin18BySettingPropertiesWithIncorrectStringDatatype() {
    $l = new Conduit\LivEx\LWINType("1006045");
    $this->assertEquals($l->is7(), true);

    $l->vintage = "2015";

    $this->assertEquals($l->is11(), true);

    $l->bottleVolume = "750";

    $this->assertEquals($l->is16(), true);

    $l->caseSize = "6";

    $this->assertEquals($l->is18(), true);
  }

  public function testValidLwin7CanBeProgressivelyExtendedUpToLwin18BySettingPropertiesWithIncorrectStringDatatypeAndTolerateNonNumericCharacters() {
    $l = new Conduit\LivEx\LWINType("1006045");
    $this->assertEquals($l->is7(), true);

    $l->vintage = "2015foobar";

    $this->assertEquals($l->is11(), true);

    $l->bottleVolume = "foob750";

    $this->assertEquals($l->is16(), true);

    $l->caseSize = "#6";

    $this->assertEquals($l->is18(), true);
  }

}
