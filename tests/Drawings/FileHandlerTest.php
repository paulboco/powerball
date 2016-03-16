<?php

class FileHandlerTest extends \PHPUnit_Framework_TestCase
{
    private $contentLength = 74132; // winnums-text.txt content length after 3/2/2016 drawing
    private $basePath = './tests/_files/';

    public function test_method_getContents_successfully_reads_winnums_text_file()
    {
        $url = $this->basePath . 'VALID.txt';
        $fileHandler = $this->createFileHandler($url);
        $fileLines = $fileHandler->getContents();
        $this->assertCount(9, $fileLines);
    }

    private function createFileHandler($url = null)
    {
        $fileValidator = $this->getMockBuilder('Paulboco\Powerball\Drawings\FileValidator')
            ->getMock();

        $fileSizer = $this->getMockBuilder('Paulboco\Powerball\Drawings\FileSizer')
            ->getMock();

        $fileHandler = new WrapFileHandler($fileValidator, $fileSizer);

        if (!is_null($url)) {
            $fileHandler->setUrl($url);
        }

        return $fileHandler;
    }

    // public function test_method_getContents_throws_exception_for_bad_url()
    // {
    //     $url = 'foo';
    //     $message = $this->tryGetContents($url);
    //     $this->assertEquals($message, 'file(foo): failed to open stream: No such file or directory');
    // }

    // public function test_method_getContents_throws_exception_for_empty_file()
    // {
    //     $url = $this->basePath . 'EMPTY-FILE.txt';
    //     $message = $this->tryGetContents($url);
    //     $this->assertEquals($message, "File '{$url}' is empty");
    // }

    // public function test_method_getContents_throws_exception_for_bad_header()
    // {
    //     $url = $this->basePath . 'ILLEGAL-HEADER.txt';
    //     $expectedHeader = 'Draw Date   WB1 WB2 WB3 WB4 WB5 PB  PP';
    //     $message = $this->tryGetContents($url);
    //     $this->assertEquals($message, "File '{$url}' did not contain the expected header '{$expectedHeader}'");
    // }

    // public function test_can_get_content_length_of_remote_file()
    // {
    //     $fileHandler = new FileHandler();
    //     $length = $fileHandler->getContentLength();
    //     $this->assertGreaterThanOrEqual($this->contentLength, $length);
    // }

    // public function test_can_get_content_length_of_local_file()
    // {
    //     $url = $this->basePath . 'VALID.txt';
    //     $fileHandler = new FileHandler($url);
    //     $length = $fileHandler->getContentLength();
    //     $this->assertEquals(339, $length);
    // }

    // public function test_method_getContentLength_throws_exception_for_non_existanct_local_file()
    // {
    //     $url = 'foo';
    //     $message = $this->tryGetContentLength($url);
    //     $this->assertEquals($message, "Could not get content length from local file '{$url}'. File does not exist");
    // }

    private function tryGetContents($url)
    {
        $message = null;

        try {
            $fileHandler = new FileHandler($url);
            $fileHandler->getContents();
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        return $message;
    }

    private function tryGetContentLength($url)
    {
        $message = null;

        try {
            $fileHandler = new FileHandler($url);
            $length = $fileHandler->getContentLength();
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        return $message;
    }
}

class WrapFileHandler extends Paulboco\Powerball\Drawings\FileHandler
{
    public function setUrl($url)
    {
        $this->url = $url;
    }
}