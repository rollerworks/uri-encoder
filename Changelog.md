# ChangeLog

The changelog describes what is "Added", "Removed", "Changed" or "Fixed" between each release.

## v2.0.0

* Bump minimum version to PHP 7.1 (and removed support for HHVM).

* Removed the deprecated `CacheEncoderDecorator`.

* Added PHP strict types and return types to all interfaces
  and classes.
  
* Classes are now marked final.

## v1.1.0

### Deprecated

* The `Rollerworks\Component\UriEncoder\Encoder\CacheEncoderDecorator`
  is deprecated.
  
  The round trip of fetching cached encoded/decoded data is heavier then the
  performance gained. And therefor caching the decoded results is no longer 
  considered a good practice.
