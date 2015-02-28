<?php

/*
 * This file is part of the Rollerworks UriEncoder Component package.
 *
 * (c) Sebastiaan Stok <s.stok@rollerscapes.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Rollerworks\Component\UriEncoder;

/**
 * UriEncoderInterface encodes a string for URL usage.
 *
 * @author Sebastiaan Stok <s.stok@rollerscapes.net>
 */
interface UriEncoderInterface
{
    /**
     * Encodes the URI to a usable format.
     *
     * @param string|int|float $data
     *
     * @return string
     */
    public function encodeUri($data);

    /**
     * Decodes the encoded URI back to the original format.
     *
     * @param string $data
     *
     * @return string|int|float
     */
    public function decodeUri($data);
}
