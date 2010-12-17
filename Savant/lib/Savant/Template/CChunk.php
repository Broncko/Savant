<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
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
class CChunk extends AEngine implements IEngine, \Savant\IConfigure
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
    const STARTDEL = "{{";

    /**
     * delimits template variables
     * @var string
     */
    const ENDDEL = "{{";

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
        switch(true)
        {
            case \is_string($pValue):
                $this->template = \str_replace(self::STARTDEL.$pParam.self::ENDDEL, $pValue, $this->template);
                break;
            case \is_array($pValue):
                $res = \preg_match('/{{for (?<var>\w+) in (?<arr>)\w+)}}(?<content>){{\/for}}/', $this->template);
                print_r($res);
                break;
            case \is_object($pValue):
                \preg_match_all('/{{([\w]+)\.([\w]+)}}/', $this->template, $res);
                \print_r($res);
                break;
        }
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
    public function _assign(\Savant\Storage\DataSet\CDataSet $pData)
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
    public function _setTemplate($pTemplateFile)
    {
        if(!\file_exists($pTemplateFile))
        {
            throw new EChunk("template doesnt exist %s",$pTemplateFile);
        }
        $this->template = \file_get_contents($pTemplateFile);
    }

    /**
     * render template
     * @param boolean $pDislay set to false to return template instead of
     * printing out
     */
    public function _render($pDisplay = true)
    {
        if($pDisplay == true)
        {
            echo $this->template;
        }
        else
        {
            return $this->template;
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

    /**
     *
     * @param <type> $pTemplate
     * @param <type> $pData
     */
    public static function create($pTemplate, $pData)
    {
        $instance = new self();
        $instance->template = $pTemplate;
        foreach($pData as $tplKey => $tplVar)
        {
            $instance->assignVar($tplKey, $tplVar);
        }
        return $instance;
    }
}