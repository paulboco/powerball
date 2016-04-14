# Powerball

[![Build Status](https://travis-ci.org/paulboco/powerball.svg?branch=master)](https://travis-ci.org/paulboco/powerball)
[![Latest Stable Version](https://poser.pugx.org/paulboco/powerball/v/stable)](https://packagist.org/packages/paulboco/powerball)
[![Total Downloads](https://poser.pugx.org/paulboco/powerball/downloads)](https://packagist.org/packages/paulboco/powerball)
[![License](https://poser.pugx.org/paulboco/powerball/license)](https://packagist.org/packages/paulboco/powerball)

All Powerball drawings are available at the powerball.com website in a plain text file.
This file is updated shortly after each drawing which occurs at 10:59 p.m. Eastern Time on Wednesday and Saturday nights.

This package parses that text file into an array.

## Installation

Require this package with composer:
```
composer require paulboco/powerball
```

## Usage

### Facade:
```php
<?php

namespace Paulboco\Powerball\Drawings;

$drawingFacade = new DrawingFacade();
$length = $drawingFacade->length();
$drawings = $drawingFacade->all();

var_dump($length, $drawings);
```

### Verbose:
```php
<?php

namespace Paulboco\Powerball\Drawings;

$fileHandler = new FileHandler(new FileValidator, new FileSizer);
$length = $fileHandler->getContentLength();
$content = $fileHandler->getContent();

$fileParser = new FileParser();
$drawings = $fileParser->parse($content);

var_dump($length, $drawings);
```

### Return:
The parser returns an array where each element represents a powerball drawing.
Drawings are in ascending order by date and each is structured as:
```php
$drawing = [
    'date' => '2016-03-19',
    'ball_1' => 11,
    'ball_2' => 60,
    'ball_3' => 23,
    'ball_4' => 54,
    'ball_5' => 43,
    'power_ball' => 3,
    'power_play' => 3,
];
```
