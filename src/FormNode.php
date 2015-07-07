<?php

namespace Hum2\TwigForm;

    /*
     * This file is part of Twig.
     *
     * For the full copyright and license information, please view the LICENSE
     * file that was distributed with this source code.
     */

/**
 * Represents a form node.
 */
class FormNode extends \Twig_Node
{
    /**
     * @var bool
     */
    private static $isInitialize = false;

    public function __construct(\Twig_Node $body, \Twig_Node $arguments, $lineno, $tag = null)
    {
        parent::__construct(
            array('body' => $body, 'arguments' => $arguments),
            array('name' => 'FormNode'),
            $lineno,
            $tag
        );
    }

    /**
     * Compiles the node to PHP.
     *
     * @param \Twig_Compiler $compiler A Twig_Compiler instance
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler->addDebugInfo($this);
        if (!self::$isInitialize) {
            $compiler
                ->write('$factory   = new \Aura\Session\SessionFactory;' . "\n")
                ->write('$session   = $factory->newInstance($_COOKIE);' . "\n")
                ->write('$session->getCsrfToken()->regenerateValue();', "\n")
                ->write('$csrfValue = $session->getCsrfToken()->getValue();' . "\n");
            self::$isInitialize = true;
        }
        $html = '<form ';
        $args = $this->getNode('arguments');
        foreach ($args as $name => $default) {
            $compiler
                ->raw("\t\t" . '$__' . $name . '__ = ')
                ->subcompile($default)
                ->raw(";\n");
            $html .= $name . '="{$__' . $name . '__}" ';
        }
        $html = rtrim($html, ' ') . ">\\n";

        $compiler
            ->write('echo "' . str_replace('"', '\"', $html) . '";' . "\n")
            ->subcompile($this->getNode('body'))
            ->write('echo "<input type=\"hidden\" name=\"__csrf_value\" value=\"$csrfValue\">\\n"' . ";\n")
            ->write("echo \"</form>\\n\";");
    }
}
