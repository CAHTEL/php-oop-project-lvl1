<?php

namespace Hexlet\Validator\Tests;

use Hexlet\Validator\Validator;
use PHPUnit\Framework\TestCase;

class CustomSchemaTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testCustom()
    {
        $validator = new Validator();

        $fnStartWith = fn($value, $start) => str_starts_with($value, $start);
        $validator->addValidator('string', 'startWith', $fnStartWith);
        $schema = $validator->string()->test('startWith', 'h');
        $this->assertTrue($schema->isValid('hexlet!'));
        $this->assertFalse($schema->isValid('exlet!'));
    }
}
