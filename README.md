# PHP-LivEx

A composer-installable set of classes for easily interacting with the various Liv-Ex APIs. 

See http://www.developers.liv-ex.com/ for more information.

## Important Limitations

- Currently, only [CellarView2](https://e767cb5f8a24933f1193-10d7789927afb962c5fef2cb2f4d8412.ssl.cf3.rackcdn.com/Cellar%20View%202%20API%20Documentation_v4.pdf) functionality is implemented. Full coverage of all APIs are planned.

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

`
