<?php

namespace App\ENUMs;

use ReflectionClass;

class BaseEnum
{
    static function getConstants()
    {
        // instantiate ReflectionClass for enum class
        $enumReflection = new ReflectionClass(get_called_class());
        
        // read current enum public constants
        $constants = $enumReflection->getConstants();
        
        // return array of names for all constants for current enum
        return $constants;
    }
    
    public static function getConstantsValues()
    {
        $constants = self::getConstants();
        return array_values($constants);
    }
    
    public static function getConstantValue($value)
    {
        $constants = self::getConstants();
        return $constants[strtoupper(str_replace(' ', '_', $value))];
    }
}
