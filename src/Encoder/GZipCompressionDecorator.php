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
 *
 * @author Sebastiaan Stok <s.stok@rollerscapes.net>
 */
final class GZipCompressionDecorator implements UriEncoderInterface
{
    /**
     * @var UriEncoderInterface
     */
    private $encoder;

    /**
     * @param UriEncoderInterface $encoder
     */
    public function __construct(UriEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * {@inheritdoc}
     */
    public function encodeUri(string $data): string
    {
        return $this->encoder->encodeUri(gzcompress($data));
    }

    /**
     * {@inheritdoc}
     */
    public function decodeUri(string $data): ?string
    {
        $data = $this->encoder->decodeUri($data);

        if (null === $data) {
            return null;
        }

        try {
            return gzuncompress($data) ?? null;
        } catch (\Throwable $e) {
            return null;
        }
    }
}
