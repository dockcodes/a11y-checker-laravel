<?php

namespace Dock\A11yCheckerLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class A11yChecker
 *
 * @package Dock\A11yCheckerLaravel\Facades
 * @see \Dock\A11yCheckerLaravel\Services\Contracts\A11yCheckerServiceContract
 */
class A11yChecker extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'dock-a11y-checker-laravel';
    }
}
