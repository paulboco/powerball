<?php

use Paulboco\Powerball\Drawings\Drawing;

class DrawingTest extends \PHPUnit_Framework_TestCase
{
    public function test_a_new_drawing_can_be_created()
    {
        $drawing = new Drawing(new DateTime, 1, 2, 3, 4, 5, 6, 7);

        $this->assertInstanceOf('Paulboco\Powerball\Drawings\Drawing', $drawing);
    }

    public function test_the_date_property_is_instance_of_DateTime()
    {
        $drawing = new Drawing(new DateTime, 1, 2, 3, 4, 5, 6, 7);

        $this->assertInstanceOf('DateTime', $drawing->date);
    }

    public function test_that_all_properties_except_date_are_integers()
    {
        $drawing = new Drawing(new DateTime, '1', 'two', 3.0, 4, 5, 6, 7);

        $this->assertInternalType('integer', $drawing->white_ball_1);
    }

    public function test_drawing_can_be_converted_to_an_array()
    {
        $drawing = new Drawing(new DateTime, 1, 2, 3, 4, 5, 6, 7);

        $this->assertInternalType('array', $drawing->toArray());
    }

    public function test_setting_an_property_throws_a_logic_exception()
    {
        $this->setExpectedException('LogicException');

        $drawing = new Drawing(new DateTime, 1, 2, 3, 4, 5, 6, 7);
        $drawing->foo = 'bar';
    }

    public function test_getting_an_property_throws_a_logic_exception()
    {
        $this->setExpectedException('LogicException');

        $drawing = new Drawing(new DateTime, 1, 2, 3, 4, 5, 6, 7);
        $foo = $drawing->foo;
    }
}
