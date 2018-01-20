<?php

use PHPUnit\Framework\TestCase;

final class CellarView2Test extends TestCase {

  public function testCheckGetAllReturnsDataWhenCalledWithValidCredentials() {
    global $_DATA;

    $cv = new Conduit\LivEx\Logistics\CellarView2($_DATA['key'],$_DATA['secret']);

    $ret = $cv->getAll();

    $this->assertEquals(Conduit\LivEx\Error::isError($ret), false);
    $this->assertInternalType('array', $ret);
    $this->assertGreaterThan(0, count($ret));

    unset($cv);
  }

  public function testCheckGetAllReturnsAnErrorWhenCalledWithInvalidCredentials() {

    $cv = new Conduit\LivEx\Logistics\CellarView2('foo','bar');

    $ret = $cv->getAll();

    $this->assertEquals(Conduit\LivEx\Error::isError($ret), true);

    unset($cv);

  }

  public function testCheckFindWithLwinReturnsDataWhenCalledWithValidCredentials() {
    global $_DATA;

    $cv = new Conduit\LivEx\Logistics\CellarView2($_DATA['key'],$_DATA['secret']);

    $ret = $cv->findByLwin($_DATA['valid-lwin']);

    $this->assertEquals(Conduit\LivEx\Error::isError($ret), false);
    $this->assertInternalType('array', $ret);
    $this->assertGreaterThan(0, count($ret));

    unset($cv);
  }

  public function testCheckFindWithSubAccountReturnsDataWhenCalledWithValidCredentials() {
    global $_DATA;

    $cv = new Conduit\LivEx\Logistics\CellarView2($_DATA['key'],$_DATA['secret']);

    $ret = $cv->findBySubAccount($_DATA['valid-subaccount']);

    $this->assertEquals(Conduit\LivEx\Error::isError($ret), false);
    $this->assertInternalType('array', $ret);
    $this->assertGreaterThan(0, count($ret));

    unset($cv);
  }

  public function testCheckFindWithBuyerRefReturnsDataWhenCalledWithValidCredentials() {
    global $_DATA;

    $cv = new Conduit\LivEx\Logistics\CellarView2($_DATA['key'],$_DATA['secret']);

    $ret = $cv->findByBuyerRef($_DATA['valid-buyerref']);

    $this->assertEquals(Conduit\LivEx\Error::isError($ret), false);
    $this->assertInternalType('array', $ret);
    $this->assertGreaterThan(0, count($ret));

    unset($cv);
  }

}
