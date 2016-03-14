<?php

namespace Paulboco\Powerball\Drawings;

use Exception;

class FileHandler
{
    /**
     * The URL to the winning numbers text file at powerball.com.
     *
     * @var string
     */
    private $url = 'http://www.powerball.com/powerball/winnums-text.txt';

    /**
     * The file header expected in the winning numbers file.
     *
     * @var string
     */
    const EXPECTED_HEADER = 'Draw Date   WB1 WB2 WB3 WB4 WB5 PB  PP';

    /**
     * Create a new file handler instance.
     *
     * @param  string|null  $url
     * @return void
     */
    public function __construct($url = null)
    {
        $this->url = is_null($url) ? $this->url : $url;
    }

    /**
     * Return the contents of the file as an array of file lines.
     *
     * @return array
     */
    public function getContents()
    {
        $lines = $this->readFile();
        $this->validateHeader($lines[0]);

        return $lines;
    }

    /**
     * Get the content length of the winning numbers file.
     *
     * @return integer
     */
    public function getContentLength()
    {
        if ($this->urlIsLocalFile()) {
            return $this->getLocalFilesize();
        }

        return $this->getRemoteFilesize();
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

    /**
     * Validate the file header.
     *
     * @param  string $header
     * @return void
     *
     * @throws Exception
     */
    private function validateHeader($header)
    {
        if ($header != self::EXPECTED_HEADER) {
            throw new Exception(
                sprintf(
                    "File '%s' did not contain the expected header '%s'",
                    $this->url,
                    self::EXPECTED_HEADER
                )
            );
        }
    }

    /**
     * Test if the URL is a local file.
     *
     * @return boolean
     */
    private function urlIsLocalFile()
    {
        $parts = parse_url($this->url);

        return !isset($parts['host']);
    }

    /**
     * Get the size of a local file.
     *
     * @return integer
     *
     * @throws Exception
     */
    private function getLocalFilesize()
    {
        if (!file_exists($this->url)) {
            throw new Exception(
                sprintf(
                    "Could not get content length from local file '%s'."
                    . " File does not exist",
                    $this->url
                )
            );
        }

        return filesize($this->url);
    }

    /**
     * Get the size of a remote file.
     *
     * @return integer
     */
    private function getRemoteFilesize()
    {
        $headers = @get_headers($this->url, true);

        return (integer) $headers['Content-Length'];
    }
}
