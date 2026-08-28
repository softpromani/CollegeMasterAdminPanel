<?php

namespace CollegeAdmin;

class CollegeAdmin
{
    /**
     * The current version of the College Master Admin Panel package.
     */
    const VERSION = '1.0.0';

    /**
     * Get the package version.
     */
    public static function version(): string
    {
        return self::VERSION;
    }
}
