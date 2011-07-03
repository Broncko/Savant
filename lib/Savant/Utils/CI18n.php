<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Utils;

/**
 * @package Savant
 * @subpackage Utils
 * exception handling of CI18n
 */
class EI18n extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Utils
 * provides an internationalization storage object
 */
class CI18n extends \Savant\Storage\CValueObject
{
    /**
     * default language
     * @var string
     */
    public static $LANG;

    /**
     * translates a word identified by a keyword to $pLang if set
     * @param string $pKey
     * @param string $pLang
     * @return string
     */
    public function translate($pKey, $pLang = null)
    {
        $lang = ($pLang != null ? $pLang : self::$LANG);

        if(\array_key_exists($pKey, $this->storage))
        {
            if(isset($this->storage[$pKey]->$lang))
            {
                return $this->storage[$pKey]->$lang;
            }
        }
    }
}