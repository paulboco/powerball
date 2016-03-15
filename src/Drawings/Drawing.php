<?php

namespace Paulboco\Powerball\Drawings;

use DateTime;
use LogicException;

class Drawing
{
    /**
     * The drawing date.
     *
     * @var DateTime
     */
    private $date;

    /**
     * The first white ball drawn.
     *
     * @var integer
     */
    private $white_ball_1;

    /**
     * The second white ball drawn.
     *
     * @var integer
     */
    private $white_ball_2;

    /**
     * The third white ball drawn.
     *
     * @var integer
     */
    private $white_ball_3;

    /**
     * The fourth white ball drawn.
     *
     * @var integer
     */
    private $white_ball_4;

    /**
     * The fifth white ball drawn.
     *
     * @var integer
     */
    private $white_ball_5;

    /**
     * The power ball.
     *
     * @var integer
     */
    private $power_ball;

    /**
     * The power play.
     *
     * @var integer
     */
    private $power_play;

    /**
     * Create a new drawing instance.
     *
     * @param  DateTime  $date
     * @param  integer  $white_ball_1
     * @param  integer  $white_ball_2
     * @param  integer  $white_ball_3
     * @param  integer  $white_ball_4
     * @param  integer  $white_ball_5
     * @param  integer  $power_ball
     * @param  integer  $power_play
     * @return void
     */
    public function __construct(
        DateTime $date,
        $white_ball_1,
        $white_ball_2,
        $white_ball_3,
        $white_ball_4,
        $white_ball_5,
        $power_ball,
        $power_play
    ) {
        $this->date = $date;
        $this->white_ball_1 = (integer) $white_ball_1;
        $this->white_ball_2 = (integer) $white_ball_2;
        $this->white_ball_3 = (integer) $white_ball_3;
        $this->white_ball_4 = (integer) $white_ball_4;
        $this->white_ball_5 = (integer) $white_ball_5;
        $this->power_ball = (integer) $power_ball;
        $this->power_play = (integer) $power_play;
    }

    /**
     * Return this drawing cast to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $vars = get_object_vars($this);

        $vars['date'] = $vars['date']->getTimestamp();

        return $vars;
    }

    /**
     * Get a drawing property.
     *
     * @param  string  $key
     * @return mixed
     *
     * @throws LogicException
     */
    public function __get($key)
    {
        if (property_exists($this, $key)) {
            return $this->$key;
        }

        throw new LogicException(
            sprintf("Property '%s' is illegal on class '%s'", $key, self::class)
        );
    }

    /**
     * Throw an exception if a property is trying to be set.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     *
     * @throws LogicException
     */
    public function __set($key, $value)
    {
        throw new LogicException(
            sprintf("Setting properties is illegal on class %s", self::class)
        );
    }
}
