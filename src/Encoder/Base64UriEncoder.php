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
 * Base64UriEncoder encodes/decodes URI using URI-safe base64.
 *
 * Unsafe characters are converted and stripped.
 */
final class Base64UriEncoder implements UriEncoderInterface
{
    public function encodeUri(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public function decodeUri(string $data): ?string
    {
        try {
            $decode = base64_decode(
                str_pad(strtr($data, '-_', '+/'), mb_strlen($data, '8bit') % 4, '='),
                true
            );

            return $decode === false ? null : $decode;
        } catch (\Throwable) {
            return null;
        }
    }
}
