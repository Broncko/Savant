<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Template
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 * TODO: it seems like twig template engine doesn't support namespaces yet.
 * check if that can be fixed without modifying twig code
 */
namespace Savant\Template;

class ELatex extends \Savant\EException {}

class CLatex extends AEngine implements IEngine
{
    public function __construct($pSection = 'default')
    {
        parent::__construct($pSection);
    }
}