<?php

use Paulboco\Powerball\Drawings\FileParser;

class FileParserTest extends \PHPUnit_Framework_TestCase
{
    // Raw file lines from winnums-text.txt.
    private $validData = [
        'Draw Date   WB1 WB2 WB3 WB4 WB5 PB  PP',
        '02/13/2016  07  15  36  18  19  20  2',
    ];

    private $badData = [
        'Draw Date   WB1 WB2 WB3 WB4 WB5 PB  PP',
        '02/0235 01 02',
    ];

    public function test_parser_returns_an_array_of_drawings()
    {
        $parser = new FileParser;
        $drawings = $parser->parseToDrawing($this->validData);

        $this->assertInstanceOf('Paulboco\Powerball\Drawings\Drawing', $drawings[0]);
    }

    public function test_parser_returns_an_array_of_arrays()
    {
        $parser = new FileParser;
        $drawings = $parser->parseToArray($this->validData);

        $this->assertInternalType('array', $drawings[0]);
    }

    public function test_parser_throws_an_exception_when_parsing_malformed_data()
    {
        $this->setExpectedException('Exception');

        $parser = new FileParser;
        $drawings = $parser->parseToArray($this->badData);
    }
}
