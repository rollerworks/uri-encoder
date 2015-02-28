<?php

/*
 * This file is part of the Rollerworks UriEncoder Component package.
 *
 * (c) Sebastiaan Stok <s.stok@rollerscapes.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace spec\Rollerworks\Component\UriEncoder\Encoder;

use PhpSpec\ObjectBehavior;

class Base64UriEncoderSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Rollerworks\Component\UriEncoder\Encoder\Base64UriEncoder');
    }

    public function its_an_encoder()
    {
        $this->shouldHaveType('Rollerworks\Component\UriEncoder\UriEncoderInterface');
    }

    public function it_encodes_a_uri()
    {
        $this->encodeUri('foo-bar-car')->shouldReturn('Zm9vLWJhci1jYXI');
    }

    public function it_decodes_an_encoded_uri()
    {
        $this->decodeUri('Zm9vLWJhci1jYXI')->shouldReturn('foo-bar-car');
    }

    public function it_returns_null_on_invalid_encoded_data()
    {
        $this->decodeUri('[whoops]')->shouldReturn(null);
    }
}
