# ChangeLog

The changelog describes what is "Added", "Removed", "Changed" or "Fixed" between each release. 

## v1.1.0

### Deprecated

* The `Rollerworks\Component\UriEncoder\Encoder\CacheEncoderDecorator`
  is deprecated.
  
  The round trip of fetching cached encoded/decoded data is heavier then the
  performance gained. And therefor caching the decoded results is no longer 
  considered a good practice.
