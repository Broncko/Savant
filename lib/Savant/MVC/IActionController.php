<?php
namespace Savant\MVC;

interface IActionController
{
    public function processRequest(CRequest $pRequest);
}