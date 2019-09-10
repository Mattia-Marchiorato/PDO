<?php

/**
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 */

namespace FaaPz\PDO\Test;

use FaaPz\PDO\Clause;
use FaaPz\PDO\DatabaseException;
use PHPUnit\Framework\TestCase;

class ConditionalTest extends TestCase
{
    public function testToString()
    {
        $subject = new Clause\Conditional('col', '=', 'val');

        $this->assertEquals('col = ?', $subject->__toString());
    }

    public function testToStringWithIn()
    {
        $subject = new Clause\Conditional('col', 'IN', [1, 2, 3]);

        $this->assertEquals('col IN (?, ?, ?)', $subject->__toString());
    }

    public function testToStringWithInException()
    {
        $subject = new Clause\Conditional('col', 'IN', []);

        $this->expectException(DatabaseException::class);
        $subject->__toString();
    }

    public function testToStringWithBetween()
    {
        $subject = new Clause\Conditional('col', 'BETWEEN', [1, 2]);

        $this->assertEquals('col BETWEEN (? AND ?)', $subject->__toString());
    }

    public function testToStringWithBetweenException()
    {
        $subject = new Clause\Conditional('col', 'BETWEEN', [1, 2, 3]);

        $this->expectException(DatabaseException::class);
        $subject->__toString();
    }

    public function testGetValues()
    {
        $subject = new Clause\Conditional('col', '=', 'val');

        $this->assertIsArray($subject->getValues());
        $this->assertCount(1, $subject->getValues());
    }
}