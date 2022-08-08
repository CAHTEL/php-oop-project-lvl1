<?php

use Hexlet\Validator\Validator;
use PHPUnit\Framework\TestCase;

class ArraySchemaTest extends TestCase
{
    public function testRequired()
    {
        $schema = (new Validator())->array();
        
        $this->assertTrue($schema->isValid([]));
        $this->assertTrue($schema->isValid(null));
        
        $schema->required();
        
        $this->assertTrue($schema->isValid([]));
        $this->assertFalse($schema->isValid(null));
    }
    
    public function testSizeOf()
    {
        $schema = (new Validator())->array();
        
        $this->assertTrue($schema->sizeof(5)->isValid([1, 2, 3, 4, 5]));
        $this->assertFalse($schema->sizeof(3)->isValid([1, 2, 3, 4, 5]));
    }
    
    public function testShape()
    {
        $validator = new Validator();
        $schema = $validator->array();
    
        $schema->shape([
            'name' => $validator->string()->required(),
            'age' => $validator->number()->positive(),
        ]);
    
        $this->assertTrue($schema->isValid(['name' => 'kolya', 'age' => 100]));
        $this->assertTrue($schema->isValid(['name' => 'maya', 'age' => null]));
        $this->assertFalse($schema->isValid(['name' => '', 'age' => null]));
        $this->assertFalse($schema->isValid(['name' => 'ada', 'age' => -5]));
    }
}
