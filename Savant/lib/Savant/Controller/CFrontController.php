<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the controller package Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Controller
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */

namespace Savant\Controller;

/**
 * @package    Savant
 * @subpackage Controller
 * Exception-handling for front controller
 *
 */
class EFrontController extends \Savant\EException {}


/**
 * @package    Savant
 * @subpackage Controller
 * provides front controller functionality
 * handles request from client and transforms it to needed data to proceed with the framework
 * 
 */
class CFrontController
{
    /**
     * template engine
     * @var Savant\Template\IEngine
     */
    private $engine = null;

    /**
     * create frontcontroller instance
     * @param \Savant\Template\IEngine $pEngine
     */
    public function __construct(\Savant\Template\IEngine $pEngine)
    {
        $params = self::parseRequest();
        $tplFile = \Savant\CBootstrap::$SKINS_DIR .\DIRECTORY_SEPARATOR . $params->tpl . $pEngine::SUFFIX;
        $pEngine->setTemplate($tplFile);
        $this->engine = $pEngine;
    }

    /**
     * merge template with data
     * @param \Savant\Storage\DataSet\CDataSet $pData
     */
    public function merge(\Savant\Storage\DataSet\CDataSet $pData)
    {
        foreach($pData->data as $row)
        {
            foreach($row as $tplVar => $var)
            {
                $this->engine->{$tplVar} = $var;
            }
        }
    }

    /**
     * print template
     */
    public function out()
    {
        $this->engine->render();
    }

    /**
     * parse url request
     * @return object $_REQUEST as object
     */
    public static function parseRequest()
    {
        return (object)$_REQUEST;
    }
}