<?php

namespace Paulboco\Powerball\Drawings;

use DateTime;
use Exception;

class FileParser
{
    /**
     * The required number of parts in an exploded line.
     *
     * @var integer
     */
    const REQUIRED_PARTS_COUNT = 8;

    /**
     * Parse each line of the winning numbers file into an array.
     *
     * @param  array $lines
     * @return array
     */
    public function parse($lines)
    {
        $lines = $this->deleteHeader($lines);

        foreach ($lines as $key => $line) {
            $lines[$key] = $this->parseDrawing($line);
        }

        return $lines;
    }

    /**
     * Delete the file header.
     *
     * @param  array $lines
     * @return array
     */
    private function deleteHeader($lines)
    {
        return array_slice($lines, 1);
    }

    /**
     * Parse a single drawing from a line.
     *
     * @param  string $line
     * @return array
     */
    private function parseDrawing($line)
    {
        $parts = $this->explodeLineIntoParts($line);

        return [
            $this->createTimestamp($parts[0]),
            (integer) $parts[1],
            (integer) $parts[2],
            (integer) $parts[3],
            (integer) $parts[4],
            (integer) $parts[5],
            (integer) $parts[6],
            (integer) $parts[7]
        ];
    }

    /**
     * Explode a line into an array of parts.
     *
     * @param  string $line
     * @return array
     */
    private function explodeLineIntoParts($line)
    {
        $parts = explode('  ', $line);

        $this->validatePartsCount($parts);

        return $parts;
    }

    /**
     * Validate the parts count.
     *
     * @param  array $parts
     * @return void
     *
     * @throws Exception
     */
    private function validatePartsCount($parts)
    {
        $partsCount = count($parts);

        if ($partsCount != self::REQUIRED_PARTS_COUNT) {
            throw new Exception(
                sprintf(
                    "A line must parse into %s elements. Found %s",
                    self::REQUIRED_PARTS_COUNT,
                    $partsCount
                )
            );
        }
    }

    /**
     * Create a timestamp from a date string.
     *
     * @param  string  $date
     * @return integer
     */
    private function createTimestamp($date)
    {
        return DateTime::createFromFormat('m/d/Y', $date)->setTime(23, 0);
    }
}
