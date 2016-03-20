# Powerball

[![Build Status](https://travis-ci.org/paulboco/powerball.svg?branch=master)](https://travis-ci.org/paulboco/powerball)
[![Latest Stable Version](https://poser.pugx.org/paulboco/powerball/v/stable)](https://packagist.org/packages/paulboco/powerball)
[![Total Downloads](https://poser.pugx.org/paulboco/powerball/downloads)](https://packagist.org/packages/paulboco/powerball)
[![License](https://poser.pugx.org/paulboco/powerball/license)](https://packagist.org/packages/paulboco/powerball)

All Powerball drawings are available at the powerball.com website in a plain text file.
This file is updated shortly after each drawing which occurs at 10:59 PM on Wednesday and Saturday nights.

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
$contents = $fileHandler->getContents();

$fileParser = new FileParser();
$drawings = $fileParser->parse($contents);

var_dump($length, $drawings);
```

### Return:
The parser returns an array of arrays with each structured as:
```php
    array (size=8)
      0 => int 1455404400
      1 => int 7
      2 => int 15
      3 => int 36
      4 => int 18
      5 => int 19
      6 => int 20
      7 => int 2
```
