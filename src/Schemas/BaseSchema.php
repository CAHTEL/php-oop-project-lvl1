<?php

namespace Hexlet\Validator\Schemas;

class BaseSchema
{
    protected array $checks = [];
    protected array $validators = [];
    protected bool $required = false;
    
    public function __construct(array $validators)
    {
        $this->validators = $validators;
    }
    
    public function test(string $name, mixed ...$arguments): BaseSchema
    {
        $this->addCheck($name, ...$arguments);
        return $this;
    }
    
    public function required(): BaseSchema
    {
        $this->required = true;
        $this->addCheck('required');
        return $this;
    }
    
    public function addCheck(string $name, mixed ...$arguments): void
    {
        $this->checks[] = [
            'validate' => $this->validators[$name],
            'arguments' => $arguments,
        ];
    }
    
    public function isValid(mixed $value): bool
    {
        if (!$this->required) {
            $validate = $this->validators['required'];
            if (!$validate($value)) {
                return true;
            }
        }
        foreach ($this->checks as $check) {
            ['validate' => $validate, 'arguments' => $arguments] = $check;
            
            if (!$validate($value, ...$arguments)) {
                return false;
            }
        }
        
        return true;
    }
}
