<?php
namespace Savant\Template;

class ETwig extends \Savant\EException {}

class CTwig extends AEngine implements IEngine
{
    private $twig = null;

    public function __construct()
    {
        parent::__construct();
        $twigLoaderFile = \Savant\AFramework::$EXT_DIR . \DIRECTORY_SEPARATOR . 'Twig' . \DIRECTORY_SEPARATOR . 'Autoloader.php';
        if(!\file_exists($twigLoaderFile))
        {
            throw new ETwig('cant find Twig autoloader', \Savant\AFramework::LEVEL_ERROR, array($twigLoaderFile));
        }
        require_once $twigLoaderFile;
        $loader = new \Twig_Loader_Filesystem($this->TEMPLATE_DIR);
        $options = array('cache' => $this->COMPILE_DIR);
        $this->twig = new \Twig_Environment($loader, $options);
    }

    public function loadTemplate($pTemplate = '')
    {
        $this->template = $this->twig->loadTemplate($pTemplate);
    }

    public function render()
    {
        return $this->template->render($this->data);
    }
}