<?php

namespace Hexlet\Validator\Schemas;

class StringSchema extends BaseSchema
{
    public function contains(string $substr): StringSchema
    {
        $this->addCheck('contains', $substr);
        return $this;
    }
    
    public function minLength(int $length): StringSchema
    {
        $this->addCheck('minLength', $length);
        return $this;
    }
    
    public function length(string $substr): StringSchema
    {
        $this->addCheck('length', $substr);
        return $this;
    }
}
