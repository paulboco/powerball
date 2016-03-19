<?php

use Paulboco\Powerball\Drawings\FileSizer;
use Paulboco\Powerball\Drawings\FileHandler;
use Paulboco\Powerball\Drawings\FileValidator;
use Paulboco\Powerball\Drawings\DrawingFacade;

class DrawingFacadeTest extends \PHPUnit_Framework_TestCase
{
    public function test_the_all_method_returns_an_array_of_drawings()
    {
        $facade = new DrawingFacade('./tests/_files/valid.txt');
        $drawings = $facade->all();
        $this->assertInstanceOf('Paulboco\Powerball\Drawings\Drawing', $drawings[0]);
    }

    public function test_the_all_to_array_method_returns_an_array_of_drawings_cast_to_arrays()
    {
        $facade = new DrawingFacade('./tests/_files/valid.txt');
        $drawings = $facade->allToArray();
        $this->assertInternalType('array', $drawings[0]);
    }
}