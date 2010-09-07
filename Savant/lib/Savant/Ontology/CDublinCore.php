<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 ** This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage Ontology
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\Ontology;

class EDublinCore extends \Savant\EException {}

class CDublinCore
{
    public static $DC_IDENTIFIER = array(
        'name' => 'DC.identifier'
    );

    public static $DC_FORMAT = array(
        'name' => 'DC.format',
        'scheme' => 'DCTERMS.IMT'
    );

    public static $DC_TYPE = array(
        'name' => 'DC.type',
        'scheme' => 'DCTERMS.DCMIType'
    );

    public static $DC_PUBLISHER = array(
        'name' => 'DC.publisher',
    );

    public static $DC_SUBJECT = array(
        'name' => 'DC.subject'
    );

    public static $DC_LANGUAGE = array(
        'name' => 'DC.language'
    );

    public static $DC_TITLE = array(
        'name' => 'DC.title'
    );

    public static $DC_COVERAGE = array(
        'name' => 'DC.coverage'
    );

    public static $DC_DESCRIPTION = array(
        'name' => 'DC.description'
    );

    public static $DC_CREATOR = array(
        'name' => 'DC.creator'
    );

    public static $DC_PUBLISHER = array(
        'name' => 'DC.publisher'
    );

    public static $DC_CONTRIBUTOR = array(
        'name' => 'DC.contributor'
    );

    public static $DC_RIGHTSHOLDER = array(
        'name' => 'DC.rightsHolder'
    );

    public static $DC_RIGHTS = array(
        'name' => 'DC.rights'
    );

    public static $DC_SOURCE = array(
        'name' => 'DC.source'
    );

    public static $DC_RELATION = array(
        'name' => 'DC.relation'
    );

    public static $DC_AUDIENCE = array(
        'name' => 'DC.audience'
    );

    public static $DC_DATE = array(
        'name' => 'DC.date'
    );
}