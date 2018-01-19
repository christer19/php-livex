# PHP-LivEx

A composer-installable set of classes for easily interacting with the various Liv-Ex APIs. 

See http://www.developers.liv-ex.com/ for more information.

## Important Limitations

- Currently, only [CellarView2](https://e767cb5f8a24933f1193-10d7789927afb962c5fef2cb2f4d8412.ssl.cf3.rackcdn.com/Cellar%20View%202%20API%20Documentation_v4.pdf) functionality is implemented. Full coverage of all APIs are planned.

## Feature Roadmap

1. CellarView2 (Working, ~50% test coverage)
2. LWIN API
3. Logistics API
4. Broking APIs
5. Valuations
6. Direct Market Access / Exchange Integration
7. Trading Alerts
8. My Account APIs

## Dependencies

- PHP 5.5.38 or newer
- PHP cURL (Usually included in PHP itself)
- Liv-Ex API Credentials
- [Composer](https://getcomposer.org/)

## Installation

- Run `composer require conduit\php-livex:dev-master`
- Run `composer install`
- Include the autoloader if you haven't already - `require './vendor/autoload.php';`

## Usage

*Note:* There is HTML API class documentation available in `docs/api`. 

### Quick Example: Get all CellarView items

```PHP

use \Conduit\LivEx\CellarView2;
use \Conduit\LivEx\Error;

$cv = new CellarView2('<your api key>','<your api secret>','DEV');
$r = $cv->getAll();

if(Error::isError($r)) {
  $r->pretty();
  return;
}

var_dump($r); // An array of CellarView items.

```

### Quick Example: Find all items by sub account code

```PHP

use \Conduit\LivEx\CellarView2;
use \Conduit\LivEx\Error;

$cv = new CellarView2('<your api key>','<your api secret>','DEV');
$r = $cv->findBySubAccount('subaccountcode');

if(Error::isError($r)) {
  $r->pretty();
  return;
}

var_dump($r); // An array of CellarView items, attached to "subaccountcode".

```

### Quick Example: Find all items by LWIN

```PHP

use \Conduit\LivEx\CellarView2;
use \Conduit\LivEx\Error;

$cv = new CellarView2('<your api key>','<your api secret>','DEV');
$r = $cv->findByLwin('100598920111200750');

if(Error::isError($r)) {
  $r->pretty();
  return;
}

var_dump($r); // An array of CellarView items of type LWIN 100598920111200750

```

### Quick Example: Find all items by buyer reference

```PHP

use \Conduit\LivEx\CellarView2;
use \Conduit\LivEx\Error;

$cv = new CellarView2('<your api key>','<your api secret>','DEV');
$r = $cv->findByBuyerRef('buyer-ref');

if(Error::isError($r)) {
  $r->pretty();
  return;
}

var_dump($r); // An array of CellarView items linked with buyer reference "buyer-ref"

```

## Unit Tests

PHP-LivEx comes bundled with PHPUnit tests and a test runner. Full coverage is planned.

To run the test suite, make sure you have the require-dev dependencies installed, then run `composer run test`.

## API Documentation Generator

To regenerate the API docs, using PHPDocumentor, run `composer run docs`
