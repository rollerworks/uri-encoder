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
 * GZipCompressionDecorator (de)compresses URI data and delegates
 * back to the original Encoder.
 *
 * @author Sebastiaan Stok <s.stok@rollerscapes.net>
 */
class GZipCompressionDecorator implements UriEncoderInterface
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
    public function encodeUri($data)
    {
        $data = gzcompress($data);

        return $this->encoder->encodeUri($data);
    }

    /**
     * {@inheritdoc}
     */
    public function decodeUri($data)
    {
        $data = $this->encoder->decodeUri($data);
        if (null === $data) {
            return;
        }

        $result = @gzuncompress($data);
        if (false !== $result) {
            return $result;
        }

        return;
    }
}
