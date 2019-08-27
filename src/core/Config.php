<?php

namespace core;

interface Configurable
{
    public static function get(): array;
}

abstract class Config implements Configurable
{
    public static function get(): array
    {
        return [];
    }
}
