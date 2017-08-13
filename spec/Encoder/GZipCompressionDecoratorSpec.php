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

namespace spec\Rollerworks\Component\UriEncoder\Encoder;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Rollerworks\Component\UriEncoder\UriEncoderInterface;

final class GZipCompressionDecoratorSpec extends ObjectBehavior
{
    public function let(UriEncoderInterface $encoder)
    {
        // Use a callback as we process binary data here
        $encoder->encodeUri(Argument::any())->will(function ($data) {
            return base64_encode($data[0]);
        });

        $encoder->decodeUri(Argument::any())->will(function ($data) {
            return base64_decode($data[0], true);
        });

        $this->beConstructedWith($encoder);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Rollerworks\Component\UriEncoder\Encoder\GZipCompressionDecorator');
    }

    public function its_an_encoder()
    {
        $this->shouldHaveType('Rollerworks\Component\UriEncoder\UriEncoderInterface');
    }

    public function it_encodes_a_uri()
    {
        $this->encodeUri('foo-bar-car')->shouldReturn('eJxLy8/XTUos0k1OLAIAGFEECg==');
    }

    public function it_decodes_an_encoded_uri()
    {
        $this->decodeUri('eJxLy8/XTUos0k1OLAIAGFEECg==')->shouldReturn('foo-bar-car');
    }

    public function it_returns_null_on_invalid_encoded_data()
    {
        $this->decodeUri('[whoops]')->shouldReturn(null);
    }
}
