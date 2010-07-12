<?php
namespace Savant\Template;

class ETemplateEngine extends \Savant\EException {}

class CTemplateEngine extends AStandardObject 
{
	private $__tpl = null;
	private $__sB = '{';
	private $__eB = '}';
	
	public function __construct($pTpl)
	{
		parent::__construct();
		$this->__tpl = $pTpl;
	}
	
	public function __set($pVar,$pVal)
	{
		$this->assignVar($pVar,$pVal);
	}
	
	public function assignVar($pVar, $pVal)
	{
		str_replace($__sB.$pVar.$__eB,$pVal,$this->__tpl);
	}
	
	public function assignArr($pVar, $pValArr)
	{
		
	}
	
	public function __toString()
	{
		return $this->__tpl;
	}
	
	public function __destruct()
	{
		
	}
}
