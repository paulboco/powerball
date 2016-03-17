<?php

use Paulboco\Powerball\Drawings\FileValidator;
use Paulboco\Powerball\Drawings\FileHandler;
use Paulboco\Powerball\Drawings\FileSizer;

class FileHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function test_method_successfully_reads_valid_winnums_text_file()
    {
        $url = './tests/_files/valid.txt';
        $fileHandler = $this->FileHandlerFactory($url);
        $fileLines = $fileHandler->getContents();

        $this->assertCount(5, $fileLines);
    }

    public function test_method_throws_exception_for_empty_file()
    {
        $this->setExpectedException('Exception');

        $url = './tests/_files/empty.txt';
        $fileHandler = $this->FileHandlerFactory($url);
        $fileHandler->getContents();
    }

    public function test_method_successfully_gets_the_content_length()
    {
        $url = './tests/_files/valid.txt';
        $fileHandler = $this->FileHandlerFactory($url);
        $length = $fileHandler->getContentLength();

        $this->assertEquals(194, $length);
    }

    private function FileHandlerFactory($url)
    {
        return new FileHandler(new FileValidator, new FileSizer, $url);
    }
}
