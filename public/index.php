<?php

namespace Paulboco\Powerball\Drawings;

use Exception;
use LogicException;

require 'setup.php';

/*
|--------------------------------------------------------------------------
| File Validator Tests
|--------------------------------------------------------------------------
*/

$validator = new FileValidator;

// ok
$validator->validateHeader('Draw Date   WB1 WB2 WB3 WB4 WB5 PB  PP', 'http://powerball.app/file_server.php?f=valid');
var_dump('header ok');

// throws unexpected header exception
try {
    $validator->validateHeader('foo', 'http://powerball.app/file_server.php?f=header');
} catch (Exception $e) {
    echo sprintf('<p><strong>%s Caught: %s</strong><br>%s</p>', get_class($e), $e->getMessage(), $e->getTraceAsString());
}

// dd($validator);

/*
|--------------------------------------------------------------------------
| File Sizer Tests
|--------------------------------------------------------------------------
*/

$sizer = new FileSizer;
$length1 = $sizer->getContentLength('http://powerball.app/file_server.php?f=malformed', false);
$length2 = $sizer->getContentLength('../tests/_files/valid.txt', true);

// dd($sizer, $length1, $length2);

/*
|--------------------------------------------------------------------------
| File Handler Tests
|--------------------------------------------------------------------------
*/

$handler = new FileHandler(new FileValidator, new FileSizer, 'http://powerball.app/file_server.php?f=valid');
$length = $handler->getContentLength();
$contents = $handler->getContents();

// dd($handler, $length, $contents);

/*
|--------------------------------------------------------------------------
| File Parser Tests
|--------------------------------------------------------------------------
*/

$parser = new FileParser(new DateManager);
$parseTo = 'drawing';

if ($parseTo == 'array') {
    $drawings = $parser->parseToArray($contents);
    $date = $drawings[0]['date'];
}

if ($parseTo == 'drawing') {
    $drawings = $parser->parseToDrawing($contents);
    $date = $drawings[0]->date->format('l, F d, Y');
}

/*
|--------------------------------------------------------------------------
| Catch Exceptions
|--------------------------------------------------------------------------
*/

try {
    $foo = $drawings[0]->foo;
} catch (LogicException $e) {
    echo sprintf('<p><strong>%s Caught: %s</strong><br>%s</p>', get_class($e), $e->getMessage(), $e->getTraceAsString());
}

try {
    $drawings[0]->foo = 'bar';
} catch (LogicException $e) {
    echo sprintf('<p><strong>%s Caught: %s</strong><br>%s</p>', get_class($e), $e->getMessage(), $e->getTraceAsString());
}

dd($handler, $length, $contents, $drawings, $date);
