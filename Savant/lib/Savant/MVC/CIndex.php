<?php
namespace Savant\MVC;

class EIndex extends \Savant\EException {}

class CIndex extends AAction implements IAction
{
    public function __construct(IModel $pModel)
    {
        $this->index($pModel);
    }

    public function index(IModel $pModel)
    {
        return $pModel;
    }
}