<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Service
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Service;

/**
 * @package    Savant
 * @subpackage Service
 * Exception-handling for Bitly-REST-API
 *  
 */
class EBitly extends \Savant\EException { }

/**
 * @package    Savant
 * @subpackage Service
 * Wrapper of Bitly-REST_API
 *  
 */
class CBitly extends \Savant\Protocol\CRest implements \Savant\IConfigure
{
	/**
	 * login property
	 * @var string
	 */
	public $LOGIN;
	
	/**
	 * apikey property
	 * @var string
	 */
  	public $APIKEY;
  	
  	/**
  	 * rest url property
  	 * @var string
  	 */
	public $RESTURL = 'http://api.bit.ly/shorten?version=2.0.1&longUrl=%s&login=%s&apiKey=%s';

	/**
	 * Constructor
	 * @param string $pConfig section of the configuration file
	 */
	public function __construct($pConfig = 'default')
	{
		parent::__construct($pConfig);
	}

	/**
	 * get shorten url
	 * @param string $pLongUrl url
	 * @return string
	 */
	public function _getShortUrl($pLongUrl)
	{
            $url = sprintf($this->RESTURL, $pLongUrl, $this->LOGIN, $this->APIKEY);

            if($result->statusCode != 'OK')
            {
                throw new EBitly($result->statusCode, \Savant\AFramework::LEVEL_ERROR);
            }
            else
            {
                $urlResult = $result->results->$pLongUrl;
                if(!empty($urlResult->errorCode))
                {
                    throw new EBitly($urlResult->errorMessage, \Savant\AFramework::LEVEL_ERROR);
                }
            }
            return $urlResult->shortUrl;
	}
}