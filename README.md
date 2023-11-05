﻿Rollerworks UriEncoder
======================

This package provides the Rollerworks UriEncoder component, a simple library, 
to safely encode a string for usage in a URI. Plus a zlib compression.

**Caution:**
 
> Do not use this library for encoding authorization/reset tokens, as this will leak information.
> Only use this library to transport "public" information, like a filtering preference.
>
> Use [paragonie/constant_time_encoding](https://github.com/paragonie/constant_time_encoding) 
> for time-safe en/decoding. Don't use conversion caching or compression for sensitive information!

Installation
------------

To install this package, add `rollerworks/search-uri-encoder` to your composer.json

```bash
$ php composer.phar require rollerworks/search-uri-encoder
```

Now, Composer will automatically download all required files, and install them
for you.

Requirements
------------

You need at least PHP 8.1 and optionally have support for gzip compression
enabled.

This package has no other external dependencies.

Basic usage
-----------

The usage of this library is very straightforward, each encoder encodes and decodes
a URL string.

To encode a string for safe usage in a URL call `encodeUri()` on the encoder object.

To decode an encoded string, to the original value call `decodeUri()` on the encoder object.

**Note:** Decoders will silently ignore invalid data, and return null instead.

### Base64UriEncoder

```php

require 'vendor/autoload.php';

use Rollerworks\Component\UriEncoder\Encoder as UriEncoder;

$stringEncode = 'This string is not safe, for direct usage & must encoded';

$base64Encoder = new UriEncoder\Base64UriEncoder();

$safeValue = $base64Encoder->encodeUri($stringEncode);
// $safeValue now contains a base64 URI safe encoded string

$originalValue = $base64Encoder->decodeUri($safeValue);
```

### Decorators

To keep the encoders small special features are provided in the form
of object decorators.

A decorator operates on top of the actual encoder.

* `encodeUri()` modifies the value returned by the decorated encoder.
* `decodeUri()` modifies the passed-in value before passing to the decorated encoder.

These decorators can not be used as a stand-alone.

#### GZipCompressionDecorator

The `GZipCompressionDecorator` (de)compresses URI data.

**Caution:** The GZipCompressionDecorator creates a non-safe binary result,
make sure the original encoder supports this.

```php

require 'vendor/autoload.php';

use Rollerworks\Component\UriEncoder\Encoder as UriEncoder;

$stringEncode = 'This string is not safe, for direct usage & must encoded';

$base64Encoder = new UriEncoder\Base64UriEncoder();
$uriCompressor = new UriEncoder\GZipCompressionDecorator($base64Encoder);

$safeValue = $uriCompressor->encodeUri($stringEncode);
// $safeValue now contains a base64 encoded URI safe string, which internally contains the compressed result.

$originalValue = $uriCompressor->decodeUri($safeValue);
```

Versioning
----------

For transparency and insight into the release cycle, and for striving
to maintain backward compatibility, this package is maintained under
the Semantic Versioning guidelines as much as possible.

Releases will be numbered with the following format:

`<major>.<minor>.<patch>`

And constructed with the following guidelines:

* Breaking backward compatibility bumps the major (and resets the minor and patch)
* New additions without breaking backward compatibility bumps the minor (and resets the patch)
* Bug fixes and misc changes bumps the patch

For more information on SemVer, please visit <http://semver.org/>.

License
-------

The package is provided under the none-restrictive MIT license,
you are free to use it for any free or proprietary product/application,
without restrictions.

[LICENSE](LICENSE)
