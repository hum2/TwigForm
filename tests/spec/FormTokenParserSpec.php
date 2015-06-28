<?php

namespace spec\Hum2\TwigForm;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FormTokenParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Hum2\TwigForm\FormTokenParser');
    }
}
