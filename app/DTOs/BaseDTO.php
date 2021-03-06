<?php
namespace App\DTOs;

use Exception;
use ReflectionObject;
use ReflectionProperty;
use Illuminate\Support\Collection;

class BaseDTO
{
    private function __construct()
    {
        // to not call from outside
    }
    
    
    /**
    * @param array $data
    * @return static
    * @throws Exception
    */
    public static function fromArray(array $data)
    {
        $self = new static();
        
        $properties = self::getProperties($self);
        
        foreach ($properties as $property) {
            if (!array_key_exists($property->name, $data)) {
                $cn = static::class;
                throw new Exception("missing [$property->name] attr from DTO [$cn]");
            }
            
            $self->{$property->name} = $data[$property->name];
        }
        return $self;
    }
    
    /**
    * @param Collection $data
    * @return static
    * @throws \Exception
    */
    public static function fromCollection(Collection $data)
    {
        return self::fromArray($data->toArray());
    }
    
    /**
    * @param BaseDTO $self
    * @return ReflectionProperty[]
    */
    private static function getProperties(BaseDTO $self)
    {
        $reflection = new ReflectionObject($self);
        return $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
    }
    
    public function toCollection()
    {
        return Collection::make($this->toArray());
    }
    
    public function toArray()
    {
        $atts = self::getProperties($this);
        $data = [];
        
        foreach ($atts as $att) {
            $data[$att->name] = $this->{$att->name};
        }
        return $data;
    }
    
    /**
    * @param BaseDTO $DTO
    * @return static
    * @throws \Exception
    */
    public static function convertFrom(BaseDTO $DTO)
    {
        return self::fromArray($DTO->toArray());
    }
    
    public function only($keys)
    {
        return self::toCollection()->only($keys);
    }
    
    
}
