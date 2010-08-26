<?php

/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the utility tools of the Savant PHP Framework.
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Protocol
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Protocol;

/**
 * @package Savant
 * @subpackage Protocol
 * Exception-handling for Http-Protocoll
 *
 */
class EHttp extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Protocol
 * This class implements get and post from the http protocol
 *
 * TODO: handle http error codes correctly (catch and pass through EHttp)
 */
class CHttp extends \Savant\AStandardObject implements \Savant\IConfigure
{
    /**
     * http request method GET
     * @var string
     */
    const HTTP_GET = 'GET';

    /**
     * http request method POST
     * @var string
     */
    const HTTP_POST = 'POST';

    /**
     * url to send http request to
     * @var string
     */
    public $REQUEST_URL = null;

    /**
     * request type whether GET or POST
     * @var string
     */
    public $REQUEST_TYPE = self::HTTP_POST;
    
    /**
     * set default content type
     * @var string
     */
    public $CONTENT_TYPE = \Savant\CBootstrap::CONTENT_TYPE_XML;

    /**
     * object holding stream resource
     * @var resource
     */
    private $streamPointer = null;

    /**
     * Constructor
     * @param string $pUrl url
     */
    public function __construct($pSection = 'default')
    {
        parent::__construct($pSection);
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        if(is_resource($this->streamPointer))
        {
            fclose($this->streamPointer);
        }
    }

    /**
     * Set stream pointer
     * @param resource $pSp stream pointer
     */
    public function setStreamPointer($pSp = null)
    {
        if(is_resource($pFp))
        {
            $this->streamPointer = $pFp;
        }
        else
        {
            throw new EHttp('given streamPointer is not of type resource');
        }
    }

    /**
     * send http request     * @param string $pType request type GET/POST
     * @param array $pContent associative array of parameters
     * @param string $pType request type GET/POST
     * @return string any type of data
     */
    public function send($pContent, $pType = null)
    {
        if(\is_null($pType))
        {
            $pType = $this->REQUEST_TYPE;
        }
        switch(strtoupper($pType))
        {
            case self::HTTP_GET:
                $context = self::buildGetContext($pContent);
                $url = $this->REQUEST_URL . '?' . $context;
                echo file_get_contents($url);
                break;
            case self::HTTP_POST:
                $context = self::buildPostContext($pContent, $this->CONTENT_TYPE);
                return file_get_contents($this->REQUEST_URL, false, $context);
                break;
            default:
                throw new EHttp('unknown request type, possible types: GET, POST');
        }
    }

    /**
     * build get context
     * @param array $pParams associative array of parameters
     * @return string http formatted query
     */
    private static function buildGetContext($pParams = array())
    {
        return http_build_query($pParams);
    }

    /**
     * build post context
     * @param array $pParams associative array of parameters
     * @return resource http stream context
     */
    private static function buildPostContext($pParams = array(), $contentType = \Savant\CBootstrap::CONTENT_TYPE_XML)
    {
        $optArr = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: '.$contentType,
                'content' => http_build_query($pParams)
            )
        );
        return stream_context_create($optArr);
    }

    /**
     * send a post request to a webserver and read the response
     * @return mixed
     */
    public static function getPostData()
    {
        return \file_get_contents('php://input');
    }

}