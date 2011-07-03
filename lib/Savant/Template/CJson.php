<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Template
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Template;

/**
 * @package Savant
 * @subpackage Template
 * exception handling of CJson
 */
class EJson extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Template
 * provides a template engine converting data to json format
 */
class CJson extends AEngine implements IEngine
{
    /**
     * template file suffix
     * @var string
     */
    const SUFFIX = '.json';

    /**
     * render template
     * @param boolean $pDisplay
     * @return string
     */
    public function _render($pDisplay = true)
    {
        print_r($this->data);
        $data = $this->data['data'];
        if($data instanceof \Savant\Storage\DataSet\CDataSet)
        {
            $data = $data->getDataAsArray();
        }
        if($pDisplay)
        {
            echo \Savant\Protocol\CJson::encode($data);
        }
        else
        {
            return \Savant\Protocol\CJson::encode($data);
        }
    }

    public function _setTemplate($pTemplate = '')
    {
        return;
    }
}