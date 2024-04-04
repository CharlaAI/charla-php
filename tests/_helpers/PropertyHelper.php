<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Tests\_helpers;

use ReflectionClass;

final class PropertyHelper
{
    public static function getPrivateValue(object $object, string $property)
    {
        $reflection = new ReflectionClass($object);
        $property = $reflection->getProperty($property);
        $property->setAccessible(true);

        return $property->getValue($object);
    }
}
