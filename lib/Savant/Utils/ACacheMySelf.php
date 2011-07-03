<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Utils
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Utils;

/**
 * @package Savant
 * @subpackage Utils
 * provides a simple caching method to fetch cached data from the specified file
 * if the cache lifetime hasnt expired
 */
abstract class ACacheMySelf
{
    /**
     * cache lifetime in ms
     * @var integer
     */
    const CACHE_LIFETIME = 900;

    /**
     * cache file
     * @var string
     */
    public static $CACHE_FILE = '';

    /**
     * return content if cached and lifetime hasnt expired, otherwise cache
     * content and return false
     * @param string $pContent content to cache
     * @return string content if exists, otherwise cache content and return false
     */
    public static function cache($pContent = '')
    {
        if(\file_exists(self::$CACHE_FILE) && (\filemtime(self::$CACHE_TIME) + self::CACHE_LIFETIME > time()))
        {
            return \unserialize(\file_get_contents(self::$CACHE_FILE));
        }
        else
        {
            \file_put_contents(self::$CACHE_FILE, $pContent);
            chmod(self::$CACHE_FILE, 0777);
            return false;
        }
    }
}