### Installation

`composer require hazzard/cookie`

### Usage

```
use Hazzard\Cookie\Cookie;

// Set a cookie for 60 minutes.
Cookie::set('name', 'value', 60);

// Set a cookie "forever".
Cookie::forever('name', 'value');

// Retrieve a cookie.
$value = Cookie::get('name');

// Forget a cookie.
Cookie::forget('name');
```


##### Default path and domain

```
Cookie::setDefaultPathAndDomain('/path/to', 'domain.com');
```


##### Encrypted cookies

First `composer require hazzard/encryption`, then:

```
use Hazzard\Cookie\Cookie;
use Hazzard\Encryption\Encrypter;

$encrypter = new Encrypter('a random 32 character string', 'AES-256-CBC');

Cookie::setEncrypter($encrypter);
```

You can use any other encrypter as long as it has the `encrypt` and `decrypt` methods. 
