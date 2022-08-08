<?php

namespace Hexlet\Validator\Schemas;

class NumberSchema extends BaseSchema
{
    public function positive(): NumberSchema
    {
        $this->addCheck('positive');
        return $this;
    }

    public function range(int $min, int $max): NumberSchema
    {
        $this->addCheck('range', $min, $max);
        return $this;
    }
}
