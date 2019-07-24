<?php


namespace core;

interface BladeInterface
{
    public function render();
}

class Blade implements BladeInterface
{
    public function __construct()
    {

    }

    public function render()
    {

    }
}

class PagePart extends Blade
{

}

class Page extends Blade
{

}
