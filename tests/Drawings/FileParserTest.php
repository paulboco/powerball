<?php

use Paulboco\Powerball\Drawings\FileParser;

class FileParserTest extends \PHPUnit_Framework_TestCase
{
    // Raw file lines from winnums-text.txt.
    private $validData = [
        'Draw Date   WB1 WB2 WB3 WB4 WB5 PB  PP',
        '03/23/2016  11  61  31  51  41  01  1',
        '03/19/2016  12  62  32  52  42  02  2',
    ];

    private $badData = [
        'Draw Date   WB1 WB2 WB3 WB4 WB5 PB  PP',
        '02/0235 01 02',
    ];

    public function test_parser_returns_an_array_of_arrays()
    {
        $parser = new FileParser;
        $drawings = $parser->parse($this->validData);

        $this->assertInternalType('array', $drawings[0]);
    }

    public function test_parser_can_reverse_order_of_array()
    {
        $parser = new FileParser;
        $drawings = $parser->parse($this->validData, true);

        $this->assertEquals('2016-03-19', $drawings[0]['date']);
    }

    public function test_parser_creates_the_required_array_keys()
    {
        $parser = new FileParser;
        $drawings = $parser->parse($this->validData);
        $drawing = $drawings[0];

        $this->assertArrayHasKey('date', $drawing);
        $this->assertArrayHasKey('ball_1', $drawing);
        $this->assertArrayHasKey('ball_1', $drawing);
        $this->assertArrayHasKey('ball_1', $drawing);
        $this->assertArrayHasKey('ball_1', $drawing);
        $this->assertArrayHasKey('ball_1', $drawing);
        $this->assertArrayHasKey('power_ball', $drawing);
        $this->assertArrayHasKey('power_play', $drawing);
    }

    public function test_parser_throws_an_exception_when_parsing_malformed_data()
    {
        $this->setExpectedException('Exception');

        $parser = new FileParser;
        $drawings = $parser->parse($this->badData);
    }
}
