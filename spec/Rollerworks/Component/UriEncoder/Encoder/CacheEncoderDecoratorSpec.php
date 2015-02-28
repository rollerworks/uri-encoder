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
use Rollerworks\Component\UriEncoder\CacheAdapterInterface;
use Rollerworks\Component\UriEncoder\UriEncoderInterface;

class CacheEncoderDecoratorSpec extends ObjectBehavior
{
    public function let(CacheAdapterInterface $cache, UriEncoderInterface $encoder)
    {
        $encoder->decodeUri('Zm9vLWJh1jYXI')->willReturn('foo-bar-car');
        $encoder->encodeUri('foo-bar-car')->willReturn('Zm9vLWJh1jYXI');

        $this->beConstructedWith($cache, $encoder);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Rollerworks\Component\UriEncoder\Encoder\CacheEncoderDecorator');
    }

    public function its_an_encoder()
    {
        $this->shouldHaveType('Rollerworks\Component\UriEncoder\UriEncoderInterface');
    }

    public function it_returns_a_cached_result_when_existent(CacheAdapterInterface $cache, UriEncoderInterface $encoder)
    {
        $cache->contains('Zm9vLWJh1j')->willReturn(true);
        $cache->fetch('Zm9vLWJh1j')->willReturn('foobar');
        $encoder->decodeUri('Zm9vLWJh1j')->shouldNotBeCalled();

        $this->decodeUri('Zm9vLWJh1j')->shouldReturn('foobar');
    }

    public function it_delegates_to_internal_encoder_and_then_saves_to_cache_when_there_is_no_cache(CacheAdapterInterface $cache)
    {
        $cache->contains('Zm9vLWJh1jYXI')->willReturn(false);
        $cache->fetch('Zm9vLWJh1jYXI')->shouldNotBeCalled();
        $cache->save('Zm9vLWJh1jYXI', 'foo-bar-car')->shouldBeCalled();

        $this->decodeUri('Zm9vLWJh1jYXI')->shouldReturn('foo-bar-car');
    }
}
