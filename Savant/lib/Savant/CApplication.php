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
    public static $MODELS_DIR;

    /**
     * application controller folder
     * @var string
     */
    public static $CONTROLLER_DIR;

    /**
     * application views dir
     * @var string
     */
    public static $VIEWS_DIR;

    /**
     * application name
     * @var string
     */
    public $name;

    /**
     * request controller
     * @var string
     */
    private $requestController;

    /**
     * request action
     * @var string
     */
    private $requestAction;

    /**
     * create application instance
     * @param string $pName application name
     */
    public function __construct($pName)
    {
        $this->name = $pName;
        $this->initialize();
    }

    /**
     * initialize application
     */
    public function initialize()
    {
        $baseDir = self::$BASE_DIR = CBootstrap::$APP_DIR . \DIRECTORY_SEPARATOR . $this->name;
        self::$MODELS_DIR = $baseDir . \DIRECTORY_SEPARATOR . 'models';
        self::$CONTROLLER_DIR = $baseDir . \DIRECTORY_SEPARATOR . 'controller';
        self::$VIEWS_DIR = $baseDir . \DIRECTORY_SEPARATOR . 'views';
    }

    /**
     * get model of application
     * @param string $pModel
     * @param string $pQuery
     * @return mixed
     */
    public function getModel($pModel = 'index', $pQuery = 'index')
    {
        $this->requestController = $pModel;
        $this->requestAction = $pQuery;

        $file = self::$MODELS_DIR . \DIRECTORY_SEPARATOR . $pModel.'.php';
        if(!\file_exists($file))
        {
            throw new EApplication("could not find file %s of model %s", $file, $pModel);
        }
        require_once $file;
        $model = "\\".$this->name."\models\\".$pModel;
        if(!\method_exists($model, 'query'.$pQuery))
        {
            throw new EApplication("could not call action %s of %s", $pQuery, $model);
        }
        
        return new $model(new Storage\CDatabase($model::DEFAULT_DB));
    }

    /**
     * call application controller
     * @param MVC\IModel $pModel
     * @return mixed
     */
    public function callController(MVC\IModel $pModel)
    {
        $file  = self::$CONTROLLER_DIR . \DIRECTORY_SEPARATOR . $this->requestController . '.php';
        if(!\file_exists($file))
        {
            return $pModel->dsQuery($this->requestAction);
        }
        require_once $file;
        if(!\method_exists($this->requestController, $this->requestAction))
        {
            throw new EApplication("could not call action %s of %s", $this->requestController, $this->requestQuery);
        }
        $res = AGenericCallInterface::call('controller/'.$this->requestController, $this->requestQuery, array($pModel));
        return $res;
    }

    /**
     * application view
     * @param Template\IEngine $pEngine template engine
     * @param mixed $pController application controller
     * @return Template\IEngine template engine
     */
    public function view(Template\IEngine $pEngine, $pController)
    {
        $tplFile = $this->requestAction . $pEngine::SUFFIX;
        $pEngine->setTemplateDir(self::$VIEWS_DIR . \DIRECTORY_SEPARATOR . $this->requestController);
        $pEngine->setTemplate($tplFile);
        $data = new Storage\CValueObject(array('data' => $pController));
        $pEngine->assign($data);
        return $pEngine;
    }
}