<?php

namespace Cuttle\Twig\Extension;

use \Twig_Node;
use \Twig_NodeInterface;
use \Twig_Compiler;

class TwigMarkdownNode extends Twig_Node
{
    public function __construct(Twig_NodeInterface $value, $lineNo, $tag)
    {
        parent::__construct(array('value' => $value), array(), $lineNo, $tag);
    }

    /**
     * Compiles the node to PHP.
     *
     * @param \Twig_Compiler $compiler A Twig_Compiler instance
     */
    public function compile(Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write('ob_start();' . PHP_EOL)
            ->subcompile($this->getNode('value'))
            ->write('echo \Cuttle\Parser\MarkdownParser::getInstance()->transform(ob_get_clean());' . PHP_EOL)
        ;
    }
}
