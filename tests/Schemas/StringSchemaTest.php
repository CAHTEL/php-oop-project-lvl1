<?php

use Hexlet\Validator\Validator;
use PHPUnit\Framework\TestCase;

class StringSchemaTest extends TestCase
{
    public function testRequired()
    {
        $schema = (new Validator())->string();
        
        $this->assertTrue($schema->isValid(''));
        $this->assertTrue($schema->isValid(null));
        
        $schema->required();
        
        $this->assertFalse($schema->isValid(null));
        $this->assertFalse($schema->isValid(''));
    }
    
    public function testContains()
    {
        $schema = (new Validator())->string();
        
        $this->assertTrue($schema->isValid('what does the fox say'));
        $this->assertTrue($schema->isValid('hexlet'));
        
        $this->assertTrue($schema->contains('what')->isValid('what does the fox say'));
        $this->assertFalse($schema->contains('whatthe')->isValid('what does the fox say'));
    }
    
    public function testMinLength()
    {
        $schema = (new Validator())->string();
        
        $this->assertTrue($schema->minLength(5)->isValid('hexlet'));
        $this->assertFalse($schema->minLength(5)->minLength(10)->isValid('hexlet'));
    }
}
