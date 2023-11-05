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

namespace Rollerworks\Component\UriEncoder;

/**
 * UriEncoderInterface encodes a string for URL usage.
 */
interface UriEncoderInterface
{
    /**
     * Encodes the URI to a usable format.
     */
    public function encodeUri(string $data): string;

    /**
     * Decodes the encoded URI back to the original format.
     */
    public function decodeUri(string $data): ?string;
}
