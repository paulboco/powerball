<?php

use Paulboco\Powerball\Drawings\FileSizer;
use Paulboco\Powerball\Drawings\FileHandler;
use Paulboco\Powerball\Drawings\FileValidator;
use Paulboco\Powerball\Drawings\DrawingFacade;

class DrawingFacadeTest extends \PHPUnit_Framework_TestCase
{
    public function test_the_all_method_returns_an_array_of_arrays()
    {
        $facade = new DrawingFacade('./tests/_files/valid.txt');
        $drawings = $facade->all();
        $this->assertInternalType('array', $drawings[0]);
    }

    public function test_the_length_method_returns_an_integer()
    {
        $facade = new DrawingFacade('./tests/_files/valid.txt');
        $length = $facade->length();
        $this->assertEquals(189, $length);
    }
}