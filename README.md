Rollerworks UriEncoder
======================

[![Build Status](https://secure.travis-ci.org/rollerworks/rollerworks-uri-encoder.png?branch=master)](http://travis-ci.org/rollerworks/rollerworks-uri-encoder)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/0b197295-cc98-4425-afe6-ad2b59283db6/mini.png)](https://insight.sensiolabs.com/projects/0b197295-cc98-4425-afe6-ad2b59283db6)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rollerworks/rollerworks-uri-encoder/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/rollerworks/rollerworks-uri-encoder/?branch=master)

This package provides the Rollerworks UriEncoder component,
a simple library, to safely encode a string for usage in a URI.

And some minor extra's, like string compression.

## Installation

### Using Composer

To install the Rollerworks UriEncoder component,
add `rollerworks/search-uri-encoder` to your composer.json using.

```bash
$ php composer.phar require rollerworks/search-uri-encoder
```

Or manually, by adding the following to your
`composer.json` file:

```js
// composer.json
{
    // ...
    require: {
        // ...
        "rollerworks/uri-encoder": "1.0.*"
    }
}
```

Then, you can install the new dependencies by running Composer's `update`
command from the directory where your `composer.json` file is located:

```bash
$ php composer update uri-encoder
```

Now, Composer will automatically download all required files, and install them
for you.

## Basic usage

The usage of this library is very straightforward, each encoder encodes and decodes
a URL string.

To encode a string for safe usage in URL call `encode()` on the encoder object.

To decode an encoded string, and the original call call `decode()` on the encoder object.

**Note:** The decoder will silently ignore invalid data, and return null instead.

### Base64UriEncoder

```php
// First load the composer autoloader
require 'vendor/autoloader.php';

$stringEncode = 'This string is not safe, for direct usage & must encoded';

$base64Encoder = new \Rollerworks\Component\UriEncoder\Encoder\Base64UriEncoder();

$safeValue = $base64Encoder->encode($stringEncode);

// $safeString now contains a base64 encoded string (with some minor differences to real base64 encoding)

$originalValue = $base64Encoder->decode($safeString);
```

### GZipCompressionDecorator

The GZipCompressionDecorator (de)compresses URI data and delegates
back to the original Encoder.

This encoder is meant to be used object-decorator, it can not be used
as stand-alone.

**Caution:** The GZipCompressionDecorator creates a none-safe binary result,
make sure the original encoder supports this.

```php
// First load the composer autoloader
require 'vendor/autoloader.php';

$stringEncode = 'This string is not safe, for direct usage & must encoded';

$base64Encoder = new \Rollerworks\Component\UriEncoder\Encoder\Base64UriEncoder();
$uriCompressor = new \Rollerworks\Component\UriEncoder\Encoder\GZipCompressionDecorator($base64Encoder);

$safeValue = $uriCompressor->encode($stringEncode);

// $safeString now contains a base64 encoded string, which internally contains the compressed string

$originalValue = $uriCompressor->decode($safeString);
```

### CacheEncoderDecorator

The CacheEncoderDecorator keeps a cached version of original data
and delegates calls back to the original Encoder when no there is no cache.

**Caution:** Caching is something that should be only be used when decoding
costs more then the overhead of using a cache.

By default this library doesn't provide any caching driver.
You must create your own and implement the `Rollerworks\Component\UriEncoder\CacheAdapterInterface`.

```php
// First load the composer autoloader
require 'vendor/autoloader.php';

// \\Rollerworks\Component\UriEncoder\CacheAdapterInterface
$cacheDriver = ...;

$stringEncode = 'This string is not safe, for direct usage & must encoded';

$base64Encoder = new \Rollerworks\Component\UriEncoder\Encoder\Base64UriEncoder();
$cacheEncoder = new \Rollerworks\Component\UriEncoder\Encoder\CacheEncoderDecorator($cacheDriver, $base64Encoder);

$safeValue = $cacheEncoder->encode($stringEncode);

// $safeString now contains a base64 encoded string
// and the result is cached using the cacheDriver.

$originalValue = $cacheEncoder->decode($safeString);
```



