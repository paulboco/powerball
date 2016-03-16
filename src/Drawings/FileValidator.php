<?php

namespace Paulboco\Powerball\Drawings;

use Exception;

class FileValidator
{
    /**
     * The file header expected in the winning numbers file.
     *
     * @var string
     */
    const EXPECTED_HEADER = 'Draw Date   WB1 WB2 WB3 WB4 WB5 PB  PP';

    /**
     * Validate the file header.
     *
     * @param  string  $header
     * @param  string  $url
     * @return void
     *
     * @throws Exception
     */
    public function validateHeader($header, $url)
    {
        if ($header != self::EXPECTED_HEADER) {
            throw new Exception(
                sprintf(
                    "File '%s' did not contain the expected header '%s'",
                    $url,
                    self::EXPECTED_HEADER
                )
            );
        }
    }

    /**
     * Validate the URL.
     *
     * @param  string  $url
     * @param  boolean  $local
     * @return void
     *
     * @throws Exception
     */
    public function validateUrl($url, $local)
    {
        if ($local) {
            $this->validateLocalUrl($url);
            return;
        }

        $this->validateRemoteUrl($url);
    }

    /**
     * Validate a local URL.
     *
     * @param  string  $url
     * @return void
     */
    private function validateLocalUrl($url)
    {
        if (!file_exists($url)) {
            throw new Exception(
                sprintf("Local file '%s' does not exist", $url)
            );
        }
    }

    /**
     * Validate a remote URL.
     *
     * @param  string  $url
     * @return void
     */
    private function validateRemoteUrl($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_NOBODY, true);

        if (curl_exec($curl) !== false) {
            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($statusCode == 200) {
                return;
            }
        }

        throw new Exception(
            sprintf("Remote file '%s' could not be found", $url)
        );
    }
}
