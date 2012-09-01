<?php

namespace Cuttle\Twig\Extension;

use Cuttle\Parser\MarkdownParser;
use \Twig_Extension;
use \Twig_Filter_Function;

class TwigMarkdownExtension extends Twig_Extension
{
    public function getTokenParsers()
    {
        return array(
            new TwigMarkdownTokenParser(),
        );
    }

    public function getFilters()
    {
        $filters = array(
            'markdown' => new Twig_Filter_Function(function ($text) {
                return MarkdownParser::getInstance()->transform($text);
            }),
        );

        return $filters;
    }

    public function getName()
    {
        return 'markdown';
    }
}
