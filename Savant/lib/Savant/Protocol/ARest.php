<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Protocol
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Protocol;

/**
 * @package    Savant
 * @subpackage Protocol
 * Exception-handling for Rest-API
 *  
 */
class ERest extends \Savant\EException {}

/**
 * @package    Savant
 * @subpackage Protocol
 * handles REST-Requests
 * 
 */
abstract class ARest extends CHttp implements \Savant\IConfigure
{
    /**
     * request method put
     * @var string
     */
    const RM_PUT = 'PUT';

    /**
     * request method delete
     * @var string
     */
    const RM_DELETE = 'DELETE';

    /**
     * host
     * @var string
     */
    public static $HOST;

    /**
     * port
     * @var integer
     */
    public static $PORT;

    /**
     * last of the returned headers
     * @var string
     */
    protected $lastHeader;

    /**
     * create rest client instance
     * @param string $pSection
     */
    public function __construct($pSection = 'default')
    {
        parent::__construct($pSection);
    }

    public function send($pUrl, $pMethod = self::RM_GET, $pData = array())
    {
        $optArr = array(
            'http' => array(
                'method' => $pMethod,
                'header' => 'Content-Type: text/plain;charset=utf-8'
            )
        );

        $stream =  \stream_context_create($optArr);
        
        switch($pMethod)
        {
            case self::RM_PUT:
            case self::RM_POST:
                $optArr['http']['content'] = CJson::encode($pData);
                $stream =  \stream_context_create($optArr);
                $res = \file_get_contents(
                        sprintf('%s:%s/%s',self::$HOST,self::$PORT,$pUrl),
                        null,
                        $stream);
                break;
            case self::RM_DELETE:
            case self::RM_GET:
                if(count($pData) > 0)
                {
                    $res = \file_get_contents(
                            sprintf('%s:%s/%s?%s',self::$HOST,self::$PORT,$pUrl,\http_build_query($pData)),
                            null,
                            $stream);
                }
                else
                {
                    $res = \file_get_contents(
                            sprintf('%s:%s/%s',self::$HOST,self::$PORT,$pUrl),
                            null,
                            $stream);
                }
                break;
        }

        return $res;
    }
    
    public function put($pUrl, $pData = array())
    {
        print_r($this->send($pUrl, self::RM_PUT, $pData));
    }

    public function delete($pUrl)
    {
        print_r($this->send($pUrl, self::RM_DELETE));
    }

    public function get($pUrl)
    {
        print_r($this->send($pUrl));
    }
}
