<?php

namespace Hum2\TwigForm;

/*
 * This file is part of Twig.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Defines a form.
 * <pre>
 * {% form action=post_url|e, method="POST", enctype="multipart/form-data" %}
 *    <input type="text" name="keyword" />
 * {% endform %}
 * </pre>
 */
class FormTokenParser extends \Twig_TokenParser
{
    /**
     * @var string
     */
    const NAME = 'form';

    /**
     * endpoint of form
     *
     * @var string
     */
    const ENDPOINT = 'endform';

    /**
     * Parses a token and returns a node.
     *
     * @param \Twig_Token $token A Twig_Token instance
     * @return \Twig_NodeInterface A Twig_NodeInterface instance
     */
    public function parse(\Twig_Token $token)
    {
        $lineno    = $token->getLine();
        $stream    = $this->parser->getStream();
        $arguments = $this->parser->getExpressionParser()->parseArguments(true, false);

        $stream->expect(\Twig_Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse([$this, 'decideBlockEnd'], true);

        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new FormNode($body, $arguments, $lineno, $this->getTag());
    }

    public function decideBlockEnd(\Twig_Token $token)
    {
        return $token->test(self::ENDPOINT);
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @return string The tag name
     */
    public function getTag()
    {
        return self::NAME;
    }
}
