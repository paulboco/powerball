<?php

use Paulboco\Powerball\Drawings\FileParser;

class FileParserTest extends \PHPUnit_Framework_TestCase
{
    // Raw file lines from winnums-text.txt.
    private $validData = [
        'Draw Date   WB1 WB2 WB3 WB4 WB5 PB  PP',
        '03/19/2016  11  60  23  54  43  03  3',
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

    public function test_parser_creates_the_required_array_keys()
    {
        $parser = new FileParser;
        $drawings = $parser->parse($this->validData);
        $drawing = $drawings[0];

        $this->assertArrayHasKey('date', $drawing);
        $this->assertArrayHasKey('white_ball_1', $drawing);
        $this->assertArrayHasKey('white_ball_1', $drawing);
        $this->assertArrayHasKey('white_ball_1', $drawing);
        $this->assertArrayHasKey('white_ball_1', $drawing);
        $this->assertArrayHasKey('white_ball_1', $drawing);
        $this->assertArrayHasKey('power_ball', $drawing);
        $this->assertArrayHasKey('power_play', $drawing);
    }

    public function test_timestamp_converts_to_11pm_eastern_time()
    {
        $parser = new FileParser;
        $drawings = $parser->parse($this->validData);
        $date = $drawings[0]['date'];
        $dateTime = (new DateTime)->setTimeStamp($date);
        $dateTime->setTimeZone(new DateTimeZone('America/New_York'));

        $this->assertEquals('23:00:00', $dateTime->format('H:i:s'));
    }

    public function test_parser_throws_an_exception_when_parsing_malformed_data()
    {
        $this->setExpectedException('Exception');

        $parser = new FileParser;
        $drawings = $parser->parse($this->badData);
    }
}
