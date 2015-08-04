<?php

namespace Hum2\TwigForm;

class FormExtension extends \Twig_Extension
{
    /**
     * Returns the token parser instances to add to the existing list.
     *
     * @return array An array of Twig_TokenParserInterface or Twig_TokenParserBrokerInterface instances
     */
    public function getTokenParsers()
    {
        return [new FormTokenParser()];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'form';
    }
}