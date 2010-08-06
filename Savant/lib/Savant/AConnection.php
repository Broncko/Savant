<?php
namespace Savant;

class EConnection extends EException{}

abstract class AConnection extends AStandardObject implements IConfigure, IConnection 
{
	public $HOST = '';

        public $PORT = 0;
	
	public function __construct($pConfig = 'default')
	{
		parent::__construct($pConfig);
	}
	
	public function connect()
	{
		
	}
	
	public function disconnect()
	{
		
	}
}