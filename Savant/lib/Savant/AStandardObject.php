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
namespace Savant;
use Savant\AOP;

class EFrameworkInterceptor extends \Exception {}

/**
 * @abstract AStandardObject
 * @package Savant
 * Main class, which encapsules basic functionality of all objects. It defines the top of the class tree
 * every new class should extend from this. (wait a minute, godclasses are evil!)
 */
abstract class AStandardObject
{
    /**
     * Logfile
     * @var string
     */
    public $LOGFILE = null;

    /**
     * file containing class configuration
     * @var string
     */
    public $confFile = null;

    /**
     * config section
     * @var string
     */
    public $confSection = null;

    /**
     * contains content of the xml configuration section
     * @var SimpleXMLElement
     */
    public $config = null;

    /**
     * set dtd validation when conf$pObj->ig is being loaded *eventually deprecated*
     * @var boolean
     */
    protected static $_DTD_VALID = true;

    /**
     * create a standardobject instance
     * @param string $pConfig section of the configuration file
     */
    public function __construct($pConfig = 'default')
    {
        $this->confSection = $pConfig;
        $this->confFile = CBootstrap::getConfigFile(\get_class($this));
        AOP\AFramework::weave($this, new AOP\JoinPoints\CConstructor(\get_class($this)));
    }

    /**
     * magic funtion __call
     * implements aop functionality by invoking methods which have a underscore(_) prefix
     * and weave in aspects before and after method
     * @param string $pMethod methodname
     * @param array $pArgs arguments
     */
    public function __call($pMethod = '', $pArgs = array())
    {
        $aspectMethod = '_'.$pMethod;
        if(!\method_exists($this, $aspectMethod))
        {
            throw new EFrameworkInterceptor(sprintf("aspectized method %s does not exists\n",$aspectMethod));
        }
        $joinPoint = new AOP\JoinPoints\CMethodCall(\get_class($this), $pMethod, $pArgs);
        AOP\AFramework::weaveIn($this, $joinPoint);
        $joinPoint->result = call_user_method_array($aspectMethod,$this,$pArgs);
        AOP\AFramework::weaveOut($this, $joinPoint);
        return $joinPoint->result;
    }

    /**
     * magic function __get
     * returns the object itself
     * @param string $pName
     */
    public function __get($pName)
    {
        if(isset($this->config) && \property_exists($this->config, $pName))
        {
            return $this->config->{$pName};
        }
    }

    /**
     * execute when object is serialized
     * @return string
     */
    public function __sleep()
    {
        return CJson::encode($this);
    }

    /**
     * execute when object is unserialized
     * @return mixed
     */
    public function __wakeup()
    {
        return CJson::decode($this);
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        AOP\AFramework::weave($this, new AOP\JoinPoints\CDestructor(\get_class($this)));
    }

    /**
     * create class instance, without using the constructor directly
     * @return object
     */
    public static function create()
    {
        return CBootstrap::invoke(\get_class());
    }

    public function singleton()
    {

    }
}