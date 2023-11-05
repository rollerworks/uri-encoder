<?php

declare(strict_types=1);

/*
 * This file is part of the Rollerworks UriEncoder package.
 *
 * (c) Sebastiaan Stok <s.stok@rollerscapes.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Rollerworks\Component\UriEncoder\Encoder;

use Rollerworks\Component\UriEncoder\UriEncoderInterface;

/**
 * GZipCompressionDecorator (de)compresses URI data and delegates
 * back to the original Encoder.
 */
final class GZipCompressionDecorator implements UriEncoderInterface
{
    public function __construct(private UriEncoderInterface $encoder) {}

    public function encodeUri(string $data): string
    {
        return $this->encoder->encodeUri((string) @gzcompress($data));
    }

    public function decodeUri(string $data): ?string
    {
        $decoded = $this->encoder->decodeUri($data);

        if ($decoded === null) {
            return null;
        }

        try {
            $compressed = @gzuncompress($decoded);

            return $compressed === false ? null : $compressed;
        } catch (\Throwable) {
            return null;
        }
    }
}
