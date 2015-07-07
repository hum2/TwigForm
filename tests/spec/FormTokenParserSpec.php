<?php

namespace spec\Hum2\TwigForm;

use Hum2\TwigForm\FormTokenParser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FormTokenParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Hum2\TwigForm\FormTokenParser');
    }

    function it_get_tag()
    {
        $this->getTag()->shouldBe(FormTokenParser::NAME);
    }

    function it_get_decideBlockEnd_is_bool()
    {
        $token = new \Twig_Token(\Twig_Token::NAME_TYPE, 'form', 2);
        $this->decideBlockEnd($token)->shouldBeBool();
    }

    /**
     * TODO fix
     *
     * @param \Twig_Token $token
     */
    function it_can_parse(\Twig_Token $token)
    {
//        $parser = $this->getParser();
//        $this->setParser($parser);
//        $this->parse($token);
    }

    /**
     * @return \Twig_Parser
     * @throws \Exception
     * @throws \Twig_Error_Syntax
     */
    private function getParser()
    {
        $stream = new \Twig_TokenStream(
            [
                new \Twig_Token(\Twig_Token::TEXT_TYPE, '<!DOCTYPE html><html><body>', 1),
                // form(method="post", action=request_uri|e)
                new \Twig_Token(\Twig_Token::BLOCK_START_TYPE, '', 2),
                new \Twig_Token(\Twig_Token::NAME_TYPE, 'form', 2),
                new \Twig_Token(\Twig_Token::PUNCTUATION_TYPE, '(', 2),
                new \Twig_Token(\Twig_Token::NAME_TYPE, 'method', 2),
                new \Twig_Token(\Twig_Token::OPERATOR_TYPE, '=', 2),
                new \Twig_Token(\Twig_Token::STRING_TYPE, 'post', 2),
                new \Twig_Token(\Twig_Token::PUNCTUATION_TYPE, ',', 2),
                new \Twig_Token(\Twig_Token::NAME_TYPE, 'action', 2),
                new \Twig_Token(\Twig_Token::OPERATOR_TYPE, '=', 2),
                new \Twig_Token(\Twig_Token::NAME_TYPE, 'request_uri', 2),
                new \Twig_Token(\Twig_Token::PUNCTUATION_TYPE, '|', 2),
                new \Twig_Token(\Twig_Token::NAME_TYPE, 'e', 2),
                new \Twig_Token(\Twig_Token::PUNCTUATION_TYPE, ')', 2),
                new \Twig_Token(\Twig_Token::BLOCK_END_TYPE, '', 2),
                new \Twig_Token(\Twig_Token::TEXT_TYPE, '<input type="submit" value="Submit">', 3),
                new \Twig_Token(\Twig_Token::BLOCK_START_TYPE, '', 4),
                new \Twig_Token(\Twig_Token::NAME_TYPE, 'endform', 4),
                new \Twig_Token(\Twig_Token::BLOCK_END_TYPE, '', 4),
                new \Twig_Token(\Twig_Token::TEXT_TYPE, '</body></html>', 5),
                new \Twig_Token(\Twig_Token::EOF_TYPE, '', 5),
            ]
        );
        $env    = new \Twig_Environment();
        $env->addTokenParser(new FormTokenParser());
        $parser = new \Twig_Parser($env);
        $parser->parse($stream);

        return $parser;
    }
}
