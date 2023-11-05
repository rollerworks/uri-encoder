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

namespace Rollerworks\Component\UriEncoder\Tests\Encoder;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Rollerworks\Component\UriEncoder\Encoder\GZipCompressionDecorator;
use Rollerworks\Component\UriEncoder\UriEncoderInterface;

final class GZipCompressionDecoratorTest extends TestCase
{
    #[Test]
    public function it_encodes_a_uri(): void
    {
        $compression = new GZipCompressionDecorator($this->getEncoder());

        self::assertSame('eJxLy8/XTUos0k1OLAIAGFEECg==', $compression->encodeUri('foo-bar-car'));
    }

    #[Test]
    public function it_decodes_an_encoded_uri(): void
    {
        $compression = new GZipCompressionDecorator($this->getEncoder());

        self::assertSame('foo-bar-car', $compression->decodeUri('eJxLy8/XTUos0k1OLAIAGFEECg=='));
    }

    #[Test]
    public function it_returns_null_on_invalid_encoded_data(): void
    {
        $compression = new GZipCompressionDecorator($this->getEncoder());

        self::assertNull($compression->decodeUri('[whoops]'));
        self::assertNull($compression->decodeUri('xknvkjsa'));
    }

    private function getEncoder(): UriEncoderInterface
    {
        return new class() implements UriEncoderInterface {
            public function encodeUri(string $data): string
            {
                return base64_encode($data);
            }

            public function decodeUri(string $data): ?string
            {
                $decode = base64_decode($data, true);

                return $decode === false ? null : $decode;
            }
        };
    }
}
