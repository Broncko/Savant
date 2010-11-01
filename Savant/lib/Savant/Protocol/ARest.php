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
class ERest extends \Savant\EException
{
    /**
     * create exception instance to decode json_encrypted rest exceptions
     */
    public function __construct()
    {
        $this->message = CJson::decode($this->getMessage());
        parent::__construct();
    }
}

/**
 * @package    Savant
 * @subpackage Protocol
 * handles REST-Requests
 * 
 */
abstract class ARest extends CHttp implements \Savant\IConfigure
{
    const RM_PUT = 'PUT';

    const RM_DELETE = 'DELETE';

    public static $HOST;

    public static $PORT;
    
    public function __construct($pSection = 'default')
    {
        parent::__construct($pSection);
    }

    public function send($pUrl, $pMethod = 'GET', $pPostData = null)
    {
        $socket = \fsockopen(self::$HOST, self::$PORT, $errno, $errmsg);
        if(!$socket)
        {
            throw new ERest("code: %s - %s", $errno, $errmsg);
        }
        $request = \sprintf("%s %s HTTP/1.0\r\nHost: localhost\r\n", $pMethod, $pUrl);

        if($pPostData) {
            $request .= "Content-Length: ".\strlen($pPostData)."\r\n\r\n";
            $request .= $pPostData."\r\n";
        }
        else
        {
            $request .= "\r\n";
        }

        \fwrite($socket, $request);
        $response = "";

        while(!\feof($socket)) {
            $response .= \fgets($socket);
        }
        return $response;
    }

    protected function put($pUrl)
    {
        list($header, $content) = explode("\r\n\r\n",$this->send($pUrl, self::RM_PUT));
        if(!isset($content['ok']) && $content['ok'] != true)
        {
            throw new ERest($content);
        }
    }
}
