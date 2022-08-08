<?php

namespace Hexlet\Validator\Schemas;

class ArraySchema extends BaseSchema
{
    public function shape(array $schemas): ArraySchema
    {
        $fn = function ($value) use ($schemas): bool {
            foreach ($schemas as $key => $schema) {
                $v = $value[$key];
                if (!$schema->isValid($v)) {
                    return false;
                };
            }
            return true;
        };
        $this->addCheck('shape', $fn);
        return $this;
    }
    
    public function sizeof(int $size): ArraySchema
    {
        $this->addCheck('sizeof', $size);
        return $this;
    }
}

