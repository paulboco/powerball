<?php

use Paulboco\Powerball\Drawings\FileValidator;

class FileValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function test_validate_header_method_throws_an_exception_when_testing_an_invalid_header()
    {
        $this->setExpectedException('Exception');

        $invalidHeader = 'foo';
        $validator = new FileValidator;
        $validator->validateHeader($invalidHeader, 'dummy/url');
    }

    public function test_validate_url_throws_an_exception_when_testing_an_invalid_remote_url()
    {
        $this->setExpectedException('Exception');

        $url = 'http://example.com/404';
        $validator = new FileValidator;
        $validator->validateHeader($invalidHeader, 'dummy/url');
    }
}
