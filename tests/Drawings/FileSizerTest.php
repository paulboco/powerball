<?php

use Paulboco\Powerball\Drawings\FileSizer;

class FileSizerTest extends \PHPUnit_Framework_TestCase
{
    public function test_method_get_content_length_returns_the_length_of_a_remote_file()
    {
        $fileSizer = new FileSizer;
        $length = $fileSizer->getContentLength('http://example.com', false);

        $this->assertEquals(1270, $length);
    }

    public function test_method_get_content_length_returns_the_length_of_a_local_file()
    {
        $fileSizer = new FileSizer;
        $length = $fileSizer->getContentLength('./tests/_files/valid.txt', true);

        $this->assertEquals(189, $length);
    }

    public function test_method_get_content_length_throws_an_exception_when_getting_the_length_of_a_non_existant_local_file()
    {
        $this->setExpectedException('Exception');

        $fileSizer = new FileSizer;
        $length = $fileSizer->getContentLength('./tests/_files/foo.txt', true);
    }
}
