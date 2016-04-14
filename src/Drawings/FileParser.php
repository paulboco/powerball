<?php

namespace Paulboco\Powerball\Drawings;

use DateTime;
use Exception;

class FileParser
{
    /**
     * The date format used in the powerball file.
     *
     * @var string
     */
    const POWERBALL_DATE_FORMAT = 'm/d/Y';

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
     * @param  boolean  $reverse
     * @return array
     */
    public function parse($lines, $reverse = false)
    {
        $lines = $this->deleteHeader($lines);

        if ($reverse) {
            $lines = array_reverse($lines);
        }

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
            'date' => $this->reformatDate($parts[0]),
            'ball_1' => (integer) $parts[1],
            'ball_2' => (integer) $parts[2],
            'ball_3' => (integer) $parts[3],
            'ball_4' => (integer) $parts[4],
            'ball_5' => (integer) $parts[5],
            'power_ball' => (integer) $parts[6],
            'power_play' => (integer) $parts[7]
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
     * Reformat date from 'm/d/Y' to 'Y-m-d'.
     *
     * @param  string  $date
     * @return integer
     */
    private function reformatDate($date)
    {
        return DateTime::createFromFormat(self::POWERBALL_DATE_FORMAT, $date)
                        ->format('Y-m-d');
    }
}
