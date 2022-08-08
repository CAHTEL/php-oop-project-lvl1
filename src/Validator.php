<?php
declare(strict_types=1);

namespace Hexlet\Validator;

class Validator
{
    private array $validators = [];
    
    public function __construct()
    {
        $this->validators = [
            'string' => [
                'required' => fn($value) => is_string($value) && $value != '',
                'contains' => fn($value, $substring) => str_contains($value, $substring),
                'minLength' => fn($value, $length) => strlen($value) >= $length
            ],
            'number' => [
                'required' => fn($value) => is_numeric($value),
                'positive' => fn($value) => $value > 0,
                'range' => fn($value, $min, $max) => $value >= $min && $value <= $max
            ],
            'array' => [
                'required' => fn($value) => is_array($value),
                'sizeof' => fn($value, $size) => count($value) == $size,
                'shape' => fn($value, $validate) => $validate($value)
            ],
        ];
    }
    
    public function string(): Schemas\StringSchema
    {
        return new Schemas\StringSchema($this->validators['string']);
    }
    
    public function number(): Schemas\NumberSchema
    {
        return new Schemas\NumberSchema($this->validators['number']);
    }
    
    public function array(): Schemas\ArraySchema
    {
        return new Schemas\ArraySchema($this->validators['array']);
    }
    
    public function addValidator(string $schema, string $name, callable $fn): void
    {
        $current = $this->validatorsPerSchema[$schema][$name] ?? null;
        if (!is_null($current)) {
            throw new \Exception("Validator {$name} for schema {$schema} already exist");
        }
        
        $this->validators[$schema][$name] = $fn;
    }
}
