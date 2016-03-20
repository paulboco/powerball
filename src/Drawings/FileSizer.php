<?php

namespace Paulboco\Powerball\Drawings;

use Exception;

class FileSizer
{
    /**
     * Get the content length of the winning numbers file.
     *
     * @param  string  $url
     * @param  boolean  $local
     * @return integer
     */
    public function getContentLength($url, $local)
    {
        if ($local) {
            return $this->getLocalFilesize($url);
        }

        return $this->getRemoteFilesize($url);
    }

    /**
     * Get the size of a local file.
     *
     * @param  string  $url
     * @return integer
     *
     * @throws Exception
     */
    private function getLocalFilesize($url)
    {
        if (!file_exists($url)) {
            throw new Exception(
                sprintf(
                    "Could not get content length from local file '%s'."
                    . ' File does not exist',
                    $url
                )
            );
        }

        return filesize($url);
    }

    /**
     * Get the size of a remote file.
     *
     * @param  string  $url
     * @return integer
     */
    private function getRemoteFilesize($url)
    {
        $headers = @get_headers($url, true);

       if (!isset($headers['Content-Length'])) {
            throw new Exception(
                sprintf(
                    "Could not get content length from remote file '%s'."
                    . " 'Content-Length' header is missing",
                    $url
                )
            );
        }

        return (integer) $headers['Content-Length'];
    }
}
