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

/**
 * @package Savant
 * exception handling of CApplication
 */
class EApplication extends EException {}

/**
 * @package Savant
 * provides an application wrapper
 */
class CApplication extends AStandardObject
{
    /**
     * application base folder
     * @var string
     */
    public static $BASE_DIR;

    /**
     * application models folder
     * @var string
     */
    public $MODELS_DIR;

    /**
     * application controller folder
     * @var string
     */
    public $CONTROLLER_DIR;

    /**
     * application views dir
     * @var string
     */
    public $VIEWS_DIR;

    /**
     * application name
     * @var string
     */
    public $name;

    /**
     * request model
     * @var string
     */
    public $model;

    /**
     * request controller
     * @var string
     */
    public $controller;

    /**
     * request action
     * @var string
     */
    public $action;

    /**
     * create application instance
     * @param string $pName application name
     */
    public function __construct($pUriParts)
    {
        $this->name = $pUriParts['app'];
        $this->initialize();
    }

    /**
     * initialize application
     */
    public function initialize()
    {
        $baseDir = self::$BASE_DIR = CBootstrap::$APP_DIR . \DIRECTORY_SEPARATOR . $this->name;
        $this->MODELS_DIR = $baseDir . \DIRECTORY_SEPARATOR . 'Models';
        $this->CONTROLLER_DIR = $baseDir . \DIRECTORY_SEPARATOR . 'Controller';
        $this->VIEWS_DIR = $baseDir . \DIRECTORY_SEPARATOR . 'Views';
    }

    /**
     * get model of application
     * @param string $pModel
     * @param string $pQuery
     * @return mixed
     */
    public function _getModel($pModel, $pAction = 'index')
    {
        $this->model = $modelName = $this->name . '\Models\\' . $pModel;
        $this->action = $pAction;

        $file = $this->MODELS_DIR . \DIRECTORY_SEPARATOR . $pModel.'.php';
        if(!\file_exists($file))
        {
            throw new EApplication("could not find file %s of model %s", $file, $pModel);
        }
        include_once($file);

        AOP\AFramework::weave(null, new AOP\JoinPoints\CClassLoader($this->model, null, $file));

        $model = new $modelName(new Storage\CDatabase($modelName::DEFAULT_DB));

        if(!($model instanceof Webservice\IRestful) && !\method_exists($model, $pAction))
        {
            throw new EApplication("could not call action %s of %s", $pAction, $this->model);
        }

        return $model;

    }

    /**
     * call application controller
     * @param MVC\IModel $pModel
     * @return mixed
     */
    public function _callController($pController = null)
    {
        $this->controller = $this->name . '\Controller\\' . $pController;
        $file  = $this->CONTROLLER_DIR . \DIRECTORY_SEPARATOR . $pController . '.php';
        
        if(\file_exists($file))
        {
            require_once $file;
            if(!\method_exists($this->controller, $this->action))
            {
                throw new EApplication("could not call action %s of %s", $this->controller, $this->action);
            }
        }
        else
        {
            return false;
        }

        $res = AGenericCallInterface::call($this->controller, $this->action);

        return $res;
    }

    /**
     * application view
     * @param Template\IEngine $pEngine template engine
     * @param mixed $pController application controller
     * @return Template\IEngine template engine
     */
    public function _view(Template\IEngine $pEngine, $pController)
    {
        $data = new Storage\CValueObject(array($this->requestController. 's' => $pController));
        $pEngine->assign($data);
        return $pEngine;
    }
}