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
        $lines = $fileHandler->getContent();

        $this->assertCount(5, $lines);
    }

    public function test_method_throws_exception_for_empty_file()
    {
        $this->setExpectedException('Exception');

        $url = './tests/_files/empty.txt';
        $fileHandler = $this->FileHandlerFactory($url);
        $fileHandler->getContent();
    }

    public function test_method_successfully_gets_the_content_length()
    {
        $url = './tests/_files/valid.txt';
        $fileHandler = $this->FileHandlerFactory($url);
        $contentLength = $fileHandler->getContentLength();

        $this->assertEquals(189, $contentLength);
    }

    private function FileHandlerFactory($url)
    {
        return new FileHandler(new FileValidator, new FileSizer, $url);
    }
}
