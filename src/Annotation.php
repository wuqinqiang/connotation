<?php

namespace Remember\Annotations;

use Remember\Annotations\Exceptions\HandleExceptions;

abstract class Annotation
{
    public static function __callStatic($name, $params)
    {
        if (substr($name, 0, 3) != 'get') {
            throw new HandleExceptions('the static method is wrong');
        }

        if (!isset($params) || count($params) == 0) {
            throw new HandleExceptions('the params is can not null');
        }

        $name = strtolower(substr($name, 3));

        $ref = new \ReflectionClass(static::class);
        $classConstants = $ref->getReflectionConstants();

        $result = [];

        foreach ($classConstants as $constant) {
            $value = $constant->getValue();
            $annotationMessage = $constant->getDocComment();
            $result[$value] = self::HandleMessage($annotationMessage, $name);
        }

        return $result[$params[0]] ?? 'no_message';

    }

    public static function HandleMessage($message, $name)
    {
        $name = str_replace(' ', '',
            ucfirst(str_replace(['_', '-'], ' ', $name)));
        $pattern = "/\@{$name}\([\'|\\\"](.*)[\'|\\\"]\)/U";
        if (preg_match($pattern, $message, $result)) {
            return $result[1];
        };
        return null;
    }
}