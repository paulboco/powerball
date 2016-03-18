<?php

use Paulboco\Powerball\Drawings\FileValidator;

class FileValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function test_validate_header_method_does_not_throw_an_exception_when_testing_a_valid_header()
    {
        $invalidHeader = 'Draw Date   WB1 WB2 WB3 WB4 WB5 PB  PP';
        $validator = new FileValidator;
        $validator->validateHeader($invalidHeader, 'dummy/url');

        $this->assertTrue(true); // no exception thrown so test passes
    }

    public function test_validate_header_method_throws_an_exception_when_testing_an_invalid_header()
    {
        $this->setExpectedException('Exception');

        $invalidHeader = 'foo';
        $validator = new FileValidator;
        $validator->validateHeader($invalidHeader, 'dummy/url');
    }

    public function test_validate_url_method_does_not_throw_an_exception_when_testing_a_valid_remote_url()
    {
        $invalidUrl = 'http://example.com';
        $validator = new FileValidator;
        $validator->validateUrl($invalidUrl, false);

        $this->assertTrue(true); // no exception thrown so test passes
    }

    public function test_validate_url_method_throws_an_exception_when_testing_an_invalid_remote_url()
    {
        $this->setExpectedException('Exception');

        $invalidUrl = 'http://example.com/404';
        $validator = new FileValidator;
        $validator->validateUrl($invalidUrl, false);
    }

    public function test_validate_url_method_does_not_throw_an_exception_when_testing_a_valid_local_url()
    {
        $invalidUrl = './tests/_files/valid.txt';
        $validator = new FileValidator;
        $validator->validateUrl($invalidUrl, true);

        $this->assertTrue(true); // no exception thrown so test passes
    }

    public function test_validate_url_method_throws_an_exception_when_testing_an_invalid_local_url()
    {
        $this->setExpectedException('Exception');

        $invalidUrl = 'foo';
        $validator = new FileValidator;
        $validator->validateUrl($invalidUrl, true);
    }
}
