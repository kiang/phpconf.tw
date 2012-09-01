<?php

namespace Cuttle\Twig\Extension;

use \Twig_TokenParser;
use \Twig_Token;

class TwigMarkdownTokenParser extends Twig_TokenParser
{
    /**
     * Parses a token and returns a node.
     *
     * @param \Twig_Token $token A Twig_Token instance
     *
     * @return \Twig_NodeInterface A Twig_NodeInterface instance
     */
    public function parse(Twig_Token $token)
    {
        $lineNo = $token->getLine();

        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);
        $value = $this->parser->subparse(array($this, 'decideMarkdownEnd'), true);
        $this->parser->getStream()->expect(Twig_Token::BLOCK_END_TYPE);

        return new TwigMarkdownNode($value, $lineNo, $this->getTag());
    }

    public function decideMarkdownEnd(Twig_Token $token)
    {
        return $token->test('endmarkdown');
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @return string
     */
    public function getTag()
    {
        return 'markdown';
    }
}
