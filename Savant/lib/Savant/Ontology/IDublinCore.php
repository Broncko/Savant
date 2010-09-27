<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Ontology
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Ontology;

/**
 * provides interface to add meta information(dublin core) to object
 */
interface IDublinCore
{
    /**
     * set meta information
     * @param \Savant\Ontology\CDublinCore $pDC
     */
    public function setMetaInformation(CDublinCore $pDC) {}
}
?>
