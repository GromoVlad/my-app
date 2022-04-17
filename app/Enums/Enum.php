<?php

declare(strict_types=1);

namespace App\Enums;

use JetBrains\PhpStorm\Pure;
use ReflectionClass;
use ReflectionException;
use WrongEnumException;

abstract class Enum
{
    private mixed $value;

    /**
     * @throws WrongEnumException
     */
    public function __construct($value)
    {
        if (!self::contains($value)) {
            throw new WrongEnumException(get_called_class(), $value);
        }
        $this->value = $value;
    }

    /**
     * Проверит, есть ли среди всех значений перечисления $needle
     */
    public static function contains($needle): bool
    {
        return in_array($needle, self::all(), true);
    }

    /**
     * Вернёт все значения перечисления в виде массива
     */
    public static function all(): array
    {
        $cls = new ReflectionClass(get_called_class());
        return array_values($cls->getConstants());
    }

    /**
     * Для каждой константы доступна возможность вызова статического метода с тем же именем,
     * который вернёт экземпляр перечисления с предустановленным значением.
     *
     * @throws WrongEnumException|ReflectionException
     */
    public static function __callStatic($name, $arguments)
    {
        $className = get_called_class();
        $cls = new ReflectionClass($className);
        $constants = $cls->getConstants();
        if (!isset($constants[$name])) {
            throw new WrongEnumException(get_called_class(), $name);
        }
        return new $className($constants[$name]);
    }

    /**
     * Вернёт значение экземпляра
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Проверяет, равен ли данный экземпляр переданному в аргументе
     */
    #[Pure]
    public function is($value): bool
    {
        if ($value instanceof Enum) {
            $value = $value->getValue();
        }
        return $this->getValue() === $value;
    }

    /**
     * Вернёт true, если данный экземпляр не равен переданному в аргументе
     */
    #[Pure]
    public function isNot($value): bool
    {
        return !$this->is($value);
    }

    /**
     * Проверяет, является ли данный экземпляр одним из переданных в аргументы
     */
    #[Pure]
    public function of(...$args): bool
    {
        foreach ($args as $status) {
            if ($this->is($status)) {
                return true;
            }
        }
        return false;
    }
}
