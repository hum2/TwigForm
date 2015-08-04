<?php

namespace spec\Hum2\TwigForm;

use Hum2\TwigForm\FormExtension;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FormExtensionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Hum2\TwigForm\FormExtension');
    }

    public function it_get_name()
    {
        $this->getName()->shouldBe('form');
    }

    public function it_get_token_parsers()
    {
        $this->getTokenParsers()->shouldBeArray();
        $this->getTokenParsers()->shouldHaveCount(1);
    }
}
