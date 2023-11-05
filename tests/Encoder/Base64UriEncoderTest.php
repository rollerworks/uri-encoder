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
use Rollerworks\Component\UriEncoder\Encoder\Base64UriEncoder;

final class Base64UriEncoderTest extends TestCase
{
    #[Test]
    public function it_encodes_a_uri(): void
    {
        $encoder = new Base64UriEncoder();

        self::assertSame('Zm9vLWJhci1jYXI', $encoder->encodeUri('foo-bar-car'));
        self::assertSame('Zm9vL2Jhci9jYXI', $encoder->encodeUri('foo/bar/car'));
        self::assertSame('Zm9vL2Jhcj9jYXI', $encoder->encodeUri('foo/bar?car'));
    }

    #[Test]
    public function it_decodes_an_encoded_uri(): void
    {
        $encoder = new Base64UriEncoder();

        self::assertSame('foo-bar-car', $encoder->decodeUri('Zm9vLWJhci1jYXI'));
        self::assertSame('foo/bar/car', $encoder->decodeUri('Zm9vL2Jhci9jYXI'));
        self::assertSame('foo/bar?car', $encoder->decodeUri('Zm9vL2Jhcj9jYXI'));
    }

    #[Test]
    public function it_returns_null_on_invalid_encoded_data(): void
    {
        $encoder = new Base64UriEncoder();

        self::assertNull($encoder->decodeUri('[whoops]'));
        self::assertNull($encoder->decodeUri('AZZSDAFSF'));
    }
}
