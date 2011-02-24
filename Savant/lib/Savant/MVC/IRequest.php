<?php
namespace Savant\MVC;

interface IRequest
{
    public function getController();

    public function getAction();

    public function getMethod();

    public function getFormat();

    public function getApp();

    public function getArguments();

    public function argumentExists();
}
?>
