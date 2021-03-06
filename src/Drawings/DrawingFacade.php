<?php

namespace Paulboco\Powerball\Drawings;

class DrawingFacade
{
    /**
     * The file handler instance.
     *
     * @var Paulboco\Powerball\Drawings\FileHandler
     */
    private $handler;

    /**
     * The file handler instance.
     *
     * @var Paulboco\Powerball\Drawings\FileParser
     */
    private $parser;

    /**
     * Create a new drawings facade instance.
     *
     * @param  string|null  $url
     * @return void
     */
    public function __construct($url = null)
    {
        $this->handler = $this->getHandler($url);
        $this->parser = new FileParser;
    }

    /**
     * Get all drawings as an array of arrays.
     *
     * @return array
     */
    public function all($reverse = false)
    {
        $content = $this->handler->getContent();

        return $this->parser->parse($content, $reverse);
    }

    /**
     * Get the content length of the winning numbers file.
     *
     * @return integer
     */
    public function length()
    {
        return $this->handler->getContentLength();
    }

    /**
     * Get a new file handler instance.
     *
     * @return Paulboco\Powerball\Drawings\FileHandler
     */
    private function getHandler($url)
    {
        return new FileHandler(new FileValidator, new FileSizer, $url);
    }
}
