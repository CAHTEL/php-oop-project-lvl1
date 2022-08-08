<?php

namespace Hexlet\Validator\Tests;

use Hexlet\Validator\Validator;
use PHPUnit\Framework\TestCase;

class NumberSchemaTest extends TestCase
{
    public function testRequired()
    {
        $validator = new Validator();
        $schema = $validator->number();

        $this->assertTrue($schema->isValid(null));
        $this->assertTrue($schema->isValid(5));

        $schema->required();

        $this->assertFalse($schema->isValid(null));
        $this->assertTrue($schema->isValid(5));
    }

    public function testRange()
    {
        $validator = new Validator();
        $schema = $validator->number()->range(-5, 5);
        $this->assertTrue($schema->isValid(-1));
        $this->assertTrue($schema->isValid(5));
        $this->assertFalse($schema->isValid(-6));
    }

    public function testPositive()
    {
        $validator = new Validator();
        $schema = $validator->number()->positive();
        $this->assertTrue($schema->isValid(10));
        $this->assertFalse($schema->isValid(-10));
    }
}
