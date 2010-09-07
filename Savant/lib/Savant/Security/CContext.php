<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the utility tools of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Security
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Security;

class EContext extends \Savant\EException {}

class CContext extends \Savant\AStandardObject implements \Savant\IConfigure
{
    public $MODULES = array();

    public $sharedState = null;

    private $moduleInstances = null;

    private $subject = null;

    public function __construct(CSubject $pSubject = null)
    {
        parent::__construct();
        $this->sharedState = new stdClass();
        if(isset($pSubject))
        {
            $this->subject = $pSubject;
        }
        else
        {
            $this->subject = CSubject::create();
        }
        $this->moduleInstances = new SplObjectStorage();
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public static function create(CSubject $pSubject = null)
    {
        return new self($pSubject);
    }

    public function login($pCredentials)
    {
        
    }
}