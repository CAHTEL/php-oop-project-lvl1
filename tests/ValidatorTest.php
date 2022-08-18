<?php

namespace Hexlet\Validator\Tests;

use Hexlet\Validator\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testStringValidator()
    {
        $schema = (new Validator())->string();

        $this->assertTrue($schema->isValid(''));
        $this->assertTrue($schema->isValid(null));

        $schema->required();

        $this->assertFalse($schema->isValid(null));
        $this->assertFalse($schema->isValid(''));

        $this->assertTrue($schema->isValid('what does the fox say'));
        $this->assertTrue($schema->isValid('hexlet'));

        $this->assertTrue($schema->minLength(5)->isValid('hexlet'));
        $this->assertFalse($schema->minLength(10)->isValid('hexlet'));

        $this->assertTrue($schema->contains('what')->isValid('what does the fox say'));
        $this->assertFalse($schema->contains('whatthe')->isValid('what does the fox say'));
    }

    public function testArrayValidator()
    {
        $validator = new Validator();
        $schema = $validator->array();

        $this->assertTrue($schema->isValid([]));
        $this->assertTrue($schema->isValid(null));

        $schema->required();

        $this->assertTrue($schema->isValid([]));
        $this->assertFalse($schema->isValid(null));

        $schema->shape([
            'name' => $validator->string()->required(),
            'age' => $validator->number()->positive(),
        ]);

        $this->assertTrue($schema->isValid(['name' => 'kolya', 'age' => 100]));
        $this->assertTrue($schema->isValid(['name' => 'maya', 'age' => null]));
        $this->assertFalse($schema->isValid(['name' => '', 'age' => null]));
        $this->assertFalse($schema->isValid(['name' => 'ada', 'age' => -5]));

        $schema = $validator->array();
        $this->assertTrue($schema->sizeof(5)->isValid([1, 2, 3, 4, 5]));
        $this->assertFalse($schema->sizeof(3)->isValid([1, 2, 3, 4, 5]));
    }

    public function testNumberValidator()
    {
        $validator = new Validator();
        $schema = $validator->number();

        $this->assertTrue($schema->isValid(null));
        $this->assertTrue($schema->isValid(5));

        $schema->required();

        $this->assertFalse($schema->isValid(null));
        $this->assertTrue($schema->isValid(5));

        $this->assertTrue($schema->range(-5, 5)->isValid(-1));
        $this->assertTrue($schema->range(-5, 5)->isValid(5));
        $this->assertFalse($schema->range(-5, 5)->isValid(-6));

        $this->assertTrue($schema->positive()->isValid(5));
        $this->assertFalse($schema->positive()->isValid(-5));
    }

    public function testCustomValidator()
    {
        $validator = new Validator();
        $fnStartWith = fn($value, $start) => str_starts_with($value, $start);
        $validator->addValidator('string', 'startWith', $fnStartWith);
        $schema = $validator->string()->test('startWith', 'h');
        $this->assertTrue($schema->isValid('hexlet!'));
        $this->assertFalse($schema->isValid('exlet!'));
    }
}
