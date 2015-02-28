<?php

/*
 * This file is part of the Rollerworks UriEncoder Component package.
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
 *
 * @author Sebastiaan Stok <s.stok@rollerscapes.net>
 */
class Base64UriEncoder implements UriEncoderInterface
{
    /**
     * {@inheritdoc}
     */
    public function encodeUri($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * {@inheritdoc}
     */
    public function decodeUri($data)
    {
        $result = @base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT), true);
        if (false !== $result) {
            return $result;
        }

        return;
    }
}
