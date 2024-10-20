<?php

namespace Michaeld555\AudioGenerator\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Michaeld555\AudioGenerator\AudioGeneratorField
 */
class AudioGeneratorField extends Facade
{

    protected static function getFacadeAccessor()
    {
        return \Michaeld555\AudioGenerator\AudioGeneratorField::class;
    }
    
}
