<?php
require_once 'bootstrapper.php';

echo "<pre>";

try {
	$bitly = new Savant\Service\CBitly();
	echo $bitly->getShortUrl('http://www.microsoft.com/germany/presseservice/default.mspx');
        //echo $bitly->getShortUrl(123);
}catch(Savant\EException $e)
{
	echo $e;
}


echo "</pre>";

?>