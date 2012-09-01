<?php

namespace Cuttle\Parser;

use \MarkdownExtra_Parser;

class MarkdownParser extends MarkdownExtra_Parser
{
    static protected $instance;

    private function __construct()
    {
        parent::__construct();
    }

    /**
     * A singleton pattern method
     *
     * @static
     * @return MarkdownParser
     */
    static public function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}
