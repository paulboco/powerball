<?php

namespace Paulboco\Powerball\Drawings;

use Exception;

class FileHandler
{
    /**
     * The file validator instance.
     *
     * @var Paulboco\Powerball\Drawings\FileValidator
     */
    private $validator;

    /**
     * The file sizer instance.
     *
     * @var Paulboco\Powerball\Drawings\FileSizer
     */
    private $sizer;

    /**
     * The URL to the winning numbers text file at powerball.com.
     *
     * @var string
     */
    protected $url = 'http://www.powerball.com/powerball/winnums-text.txt';

    /**
     * File is local flag.
     *
     * @var boolean
     */
    private $local;

    /**
     * Create a new file handler instance.
     *
     * @param  Paulboco\Powerball\Drawings\FileValidator $validator
     * @param  Paulboco\Powerball\Drawings\FileSizer     $sizer
     * @param  string|null                               $url
     * @return void
     */
    public function __construct(FileValidator $validator, FileSizer $sizer, $url = null)
    {
        $this->validator = $validator;
        $this->sizer = $sizer;
        $this->url = $url ?: $this->url;

        $this->local = $this->urlIsLocalFile();

        $this->validator->validateUrl($this->url, $this->local);
    }

    /**
     * Return the contents of the file as an array of file lines.
     *
     * @return array
     */
    public function getContents()
    {
        $lines = $this->readFile();
        $this->validator->validateHeader($lines[0], $this->url);

        return $lines;
    }

    /**
     * Get the file's content length.
     *
     * @return integer
     */
    public function getContentLength()
    {
        return $this->sizer->getContentLength($this->url, $this->local);
    }

    /**
     * Check if the URL is a local file.
     *
     * @return boolean
     */
    private function urlIsLocalFile()
    {
        $parts = parse_url($this->url);

        return !isset($parts['host']);
    }

    /**
     * Read the powerball.com file.
     *
     * @return array
     *
     * @throws Exception
     */
    private function readFile()
    {
        $contents = file($this->url, FILE_IGNORE_NEW_LINES);

        if (empty($contents)) {
            throw new Exception(sprintf("File '%s' is empty", $this->url));
        }

        return $contents;
    }
}
