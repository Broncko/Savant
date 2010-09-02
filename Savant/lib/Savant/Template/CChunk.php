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
namespace Savant\Template;

/**
 * exception handling of CChunk
 */
class EChunk extends \Savant\EException {}

/**
 * provides minimal template functionality
 */
class CChunk extends \Savant\AStandardObject implements IEngine, \Savant\IConfigure
{
    /**
     * template suffix (eg. test.chunk.html)
     * @var string
     */
    const SUFFIX = '.chunk.html';

    /**
     * delimits template variables
     * @var string
     */
    const DELIMITER = "@";

    /**
     * html template
     * @var string
     */
    private $Html = '';

    /**
     * create chunk instance
     */
    public function __construct($pSection = 'default')
    {
        parent::__construct($pSection);
    }

    /**
     * replace template var with value
     * @param string $pParam
     * @param string $pValue
     */
    private function assignVar($pParam, $pValue)
    {
        $this->Html = \str_replace(self::DELIMITER.$pParam.self::DELIMITER, $pValue, $this->Html);
    }

    /**
     * replace template var with value, alias of assignVar
     * @param string $pParam
     * @param string $pValue
     */
    public function __set($pParam, $pValue)
    {
        $this->assignVar($pParam, $pValue);
    }

    /**
     * assigns array of type key => value to template
     * @param array $pData
     */
    public function assign($pData)
    {
        if(!\is_array($pData))
        {
            throw new EChunk("template vars cant be replaced, no valid data");
        }
        foreach($pData as $tplVar => $val)
        {
            $this->assignVar($tplVar, $val);
        }
    }

    /**
     * set template
     * @param string $pTemplate
     */
    public function setTemplate($pTemplateFile)
    {
        if(!\file_exists($pTemplateFile))
        {
            throw new EChunk("template doesnt exist %s",$pTemplateFile);
        }
        $this->Html = \file_get_contents($pTemplateFile);
    }

    /**
     * render template
     * @param boolean $pDislay set to false to return template instead of
     * printing out
     */
    public function render($pDisplay = true)
    {
        if($pDisplay == true)
        {
            echo $this->Html;
        }
        else
        {
            return $this->Html;
        }
    }

    /**
     * alias of render(), just for easier usage
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}