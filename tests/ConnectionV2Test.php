<?php

use PHPUnit\Framework\TestCase;


final class ConnectionV2Test extends TestCase {

  public function testRequestReturnsAnErrorWhenDnsIsNotResolvable() {
    global $_DATA;

    $c = new Conduit\LivEx\ConnectionV2($_DATA['key'],$_DATA['secret'], 'https://foobar.baz/');

    $ret = $c->request('/lemon');

    $this->assertEquals(Conduit\LivEx\Error::isError($ret), true);
    $this->assertEquals($ret->code(), 'N001');

    unset($c);
  }

  public function testRequestReturnsA404ErrorWhenUrlIsNotFound() {
    global $_DATA;

    $c = new Conduit\LivEx\ConnectionV2($_DATA['key'],$_DATA['secret'], 'https://apistaging.liv-ex.com/');

    $ret = $c->request('/lemon/cheesecake');

    $this->assertEquals(Conduit\LivEx\Error::isError($ret), true);
    $this->assertEquals($ret->code(), 'H404');

    unset($c);
  }

  public function testRequestReturnsANetworkErrorWhenUrlIsMalformed() {
    global $_DATA;

    $c = new Conduit\LivEx\ConnectionV2($_DATA['key'],$_DATA['secret'], '');

    $ret = $c->request('/lemon/cheesecake');

    $this->assertEquals(Conduit\LivEx\Error::isError($ret), true);
    $this->assertEquals($ret->code(), 'N001');

    unset($c);
  }

}
