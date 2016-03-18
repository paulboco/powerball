<?php

namespace Paulboco\Powerball\Drawings;

use Paulboco\Powerball\Drawings\FileSizer;
use Paulboco\Powerball\Drawings\FileParser;
use Paulboco\Powerball\Drawings\FileHandler;
use Paulboco\Powerball\Drawings\FileValidator;

class DrawingsFacade
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
     * Get all drawings as an array of drawing objects.
     *
     * @return array
     */
    public function all()
    {
        $contents = $this->handler->getContents();

        return $this->parser->parseToDrawing($contents);
    }

    /**
     * Get all drawings as an array of arrays.
     *
     * @return array
     */
    public function allToArray()
    {
        $contents = $this->handler->getContents();

        return $this->parser->parseToArray($contents);
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