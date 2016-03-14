<?php

use Paulboco\Powerball\Drawings\DateManager;
use Paulboco\Powerball\Drawings\FileHandler;
use Paulboco\Powerball\Drawings\FileParser;

class FileParserTest extends \PHPUnit_Framework_TestCase
{
    private $basePath = './tests/_files/';

    public function test_parser_returns_an_array_of_arrays_with_eight_elements()
    {
        $contents = $this->getArray('VALID.txt');
        $this->assertInternalType('array', $contents);
        $this->assertInternalType('array', $contents[0]);
        $this->assertCount(8, $contents[0]);
    }

    public function test_parser_throws_an_exception_on_wrong_number_of_elements()
    {
        try {
            $this->getArray('MALFORMED-LINE.txt');
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        $this->assertEquals($message, "A line must parse into 8 elements. Found 7");
    }

    public function test_mentod_getArray_returns_the_specified_array_keys()
    {
        $contents = $this->getArray('VALID.txt');
        $this->assertArrayHasKey('date', $contents[0]);
        $this->assertArrayHasKey('white_ball_1', $contents[0]);
        $this->assertArrayHasKey('white_ball_2', $contents[0]);
        $this->assertArrayHasKey('white_ball_3', $contents[0]);
        $this->assertArrayHasKey('white_ball_4', $contents[0]);
        $this->assertArrayHasKey('white_ball_5', $contents[0]);
        $this->assertArrayHasKey('power_ball', $contents[0]);
        $this->assertArrayHasKey('power_play', $contents[0]);
    }

    public function test_method_getArray_returns_array_where_all_elements_are_integers()
    {
        $contents = $this->getArray('VALID.txt');
        $this->assertInternalType('integer', $contents[0]['date']);
        $this->assertInternalType('integer', $contents[0]['white_ball_1']);
        $this->assertInternalType('integer', $contents[0]['white_ball_2']);
        $this->assertInternalType('integer', $contents[0]['white_ball_3']);
        $this->assertInternalType('integer', $contents[0]['white_ball_4']);
        $this->assertInternalType('integer', $contents[0]['white_ball_5']);
        $this->assertInternalType('integer', $contents[0]['power_ball']);
        $this->assertInternalType('integer', $contents[0]['power_play']);
    }

    public function test_method_getDrawing_returns_the_specified_properties()
    {
        $contents = $this->getDrawing('VALID.txt');
        $this->assertObjectHasAttribute('date', $contents[0]);
        $this->assertObjectHasAttribute('white_ball_1', $contents[0]);
        $this->assertObjectHasAttribute('white_ball_2', $contents[0]);
        $this->assertObjectHasAttribute('white_ball_3', $contents[0]);
        $this->assertObjectHasAttribute('white_ball_4', $contents[0]);
        $this->assertObjectHasAttribute('white_ball_5', $contents[0]);
        $this->assertObjectHasAttribute('power_ball', $contents[0]);
        $this->assertObjectHasAttribute('power_play', $contents[0]);
    }

    public function test_method_getDrawing_returns_the_specified_property_types()
    {
        $contents = $this->getDrawing('VALID.txt');
        $this->assertInstanceOf('DateTime', $contents[0]->date);
        $this->assertInternalType('integer', $contents[0]->white_ball_1);
        $this->assertInternalType('integer', $contents[0]->white_ball_2);
        $this->assertInternalType('integer', $contents[0]->white_ball_3);
        $this->assertInternalType('integer', $contents[0]->white_ball_4);
        $this->assertInternalType('integer', $contents[0]->white_ball_5);
        $this->assertInternalType('integer', $contents[0]->power_ball);
        $this->assertInternalType('integer', $contents[0]->power_play);
    }

    private function getArray($url)
    {
        $parser = new FileParser(new DateManager);
        $contents = $this->getContents($url);

        return $parser->parseToArray($contents);
    }

    private function getDrawing($url)
    {
        $parser = new FileParser(new DateManager);
        $contents = $this->getContents($url);

        return $parser->parseToDrawing($contents);
    }

    private function getContents($url)
    {
        $file = new FileHandler($this->basePath . $url);

        return $file->getContents();
    }
}
