<?php

namespace core;

interface Configurable
{
    public static function get();
}

abstract class Config implements Configurable
{
    public static function get()
    {
        return [];
    }
}
