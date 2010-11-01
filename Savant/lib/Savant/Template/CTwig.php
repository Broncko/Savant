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
 * TODO: it seems like twig template engine doesn't support namespaces yet.
 * check if that can be fixed without modifying twig code
 */
namespace Savant\Template;
require_once \Savant\CBootstrap::$EXT_DIR.\DIRECTORY_SEPARATOR.'Twig'.\DIRECTORY_SEPARATOR.'lib'.\DIRECTORY_SEPARATOR.'Twig'.\DIRECTORY_SEPARATOR.'Autoloader.php';

/**
 * @package Savant
 * @subpackage Template
 * exception handling of CTwig
 */
class ETwig extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Template
 * this is a template engine using fabien potenciers twig template engine
 */
class CTwig extends AEngine implements IEngine
{
    /**
     * template suffix
     * @var string (eg. test.twig.html)
     */
    const SUFFIX = '.twig.html';

    /**
     * twig environment
     * @var Twig_Environment
     */
    private $twig = null;

    /**
     * create twig template engine instance
     * @param string $pSection
     */
    public function __construct($pSection = 'default')
    {
        parent::__construct($pSection);
        \Twig_Autoloader::register();
        $loader = new \Twig_Loader_Filesystem($this->TEMPLATE_DIR);
        $options = array('cache' => $this->COMPILE_DIR . \DIRECTORY_SEPARATOR . 'Twig');
        $this->twig = new \Twig_Environment($loader, $options);
    }

    /**
     * load template from file
     * @param string $pTemplate template file name
     */
    public function _setTemplate($pTemplate = '')
    {
        if(!\file_exists($this->TEMPLATE_DIR . \DIRECTORY_SEPARATOR . $pTemplate))
        {
            throw new ETwig("Unable to find template %s in %s", $pTemplate, $this->TEMPLATE_DIR);
        }
        $this->template = $this->twig->loadTemplate($pTemplate);
        /*try
        {
            $this->template = $this->twig->loadTemplate($pTemplate);
        }
        catch(\RuntimeException $exc)
        {
            throw new ETwig($exc->getMessage());
        }*/
    }

    /**
     * render template
     * @return string
     */
    public function _render($pDisplay = true)
    {
        return $this->template->render($this->data->getAll());
    }

    /**
     * class loader for twig classes
     * @param string $pClass twig class
     */
    public function loadClass($pClass)
    {
        echo $pClass."\n";
        $twigDir = \Savant\CBootstrap::$EXT_DIR . \DIRECTORY_SEPARATOR . 'Twig' . \DIRECTORY_SEPARATOR . 'lib';
        $pClass = \array_reverse(\explode('\\', $pClass));
        $twigFile = $twigDir . \DIRECTORY_SEPARATOR . str_replace('_', \DIRECTORY_SEPARATOR, $pClass[0]) . '.php';
        if(!\file_exists($twigFile))
        {
            throw new ETwig("can't find Twig class in %s", $twigFile);
        }
        echo $twigFile."\n";
        require_once $twigFile;
    }
}