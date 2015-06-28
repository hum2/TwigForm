<?php

namespace spec\Hum2\TwigForm;

use Hum2\TwigForm\FormNode;
use Hum2\TwigForm\FormTokenParser;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FormNodeSpec extends ObjectBehavior
{
    public function let(FormTokenParser $tokenParser)
    {
        $lineno    = 4;
        $arguments = new \Twig_Node(
            array(
                'method' => new \Twig_Node_Expression_Constant('post', $lineno),
                'action' => new \Twig_Node_Expression_Filter(
                    new \Twig_Node_Expression_Name('request_uri', $lineno),
                    new \Twig_Node_Expression_Constant('e', $lineno),
                    new \Twig_Node(),
                    $lineno,
                    null
                ),
                'target' => new \Twig_Node_Expression_Constant('__blank', $lineno),
            )
        );
        $body      = new \Twig_Node_Text(
            '<input type="text" name="message">' . "\n" . '<input type="submit" value="send">',
            ($lineno + 1)
        );

        $this->beConstructedWith($body, $arguments, $lineno, $tokenParser->getTag());
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Hum2\TwigForm\FormNode');
    }

    public function it_get_body_node()
    {
        $this->getNode('body')->shouldHaveType('Twig_Node_Text');
        $html = '<input type="text" name="message">' . "\n" . '<input type="submit" value="send">';
        $this->getNode('body')->getAttribute('data')->shouldBe($html);
    }

    public function it_get_method_attribute_via_arguments_node()
    {
        $this->getNode('arguments')->getNode('method')->shouldHaveType('Twig_Node_Expression_Constant');
        $this->getNode('arguments')->getNode('method')->getAttribute('value')->shouldBe('post');
    }

    public function it_get_action_attribute_via_arguments_node()
    {
        $this->getNode('arguments')->getNode('action')->getNode('node')->shouldHaveType('Twig_Node_Expression_Name');
        $this->getNode('arguments')->getNode('action')->getNode('node')->getAttribute('name')->shouldBe('request_uri');
        $this->getNode('arguments')->getNode('action')->getNode('filter')->getAttribute('value')->shouldBe('e');
    }

    public function it_get_target_attribute_via_arguments_node()
    {
        $this->getNode('arguments')->getNode('target')->shouldHaveType('Twig_Node_Expression_Constant');
        $this->getNode('arguments')->getNode('target')->getAttribute('value')->shouldBe('__blank');
    }
}
