<?php
function __autoload($pClass)
{
        $pClass = str_replace('\\', DIRECTORY_SEPARATOR, $pClass);
	$classPath = '../lib/'.str_replace('_',DIRECTORY_SEPARATOR,$pClass);
	if(!file_exists($classPath.'.php'))
	{
		throw new Savant\EException('class %s not found in %s', $pClass, $classPath, 200);
	}
	else
	{
		require_once($classPath.'.php');
	}
}