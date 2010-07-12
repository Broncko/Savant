<?php
namespace Savant;

interface IConnection
{	
	public function connect();

	public function disconnect();
}