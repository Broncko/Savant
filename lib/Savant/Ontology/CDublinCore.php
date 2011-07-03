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
 * @package Savant
 * @subpackage Ontology
 * exception handling of CDublinCore
 */
class EDublinCore extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Ontology
 * provides dublin core web ontology description for xhtml pages
 */
class CDublinCore
{
    /**
     * dublin core identifier
     * @var array
     */
    public static $DC_IDENTIFIER = array(
        'name' => 'DC.identifier'
    );

    /**
     * dublin core document/media format
     * @var array
     */
    public static $DC_FORMAT = array(
        'name' => 'DC.format',
        'scheme' => 'DCTERMS.IMT'
    );

    /**
     * dublin core document type (like mimetype)
     * @var array
     */
    public static $DC_TYPE = array(
        'name' => 'DC.type',
        'scheme' => 'DCTERMS.DCMIType'
    );

    /**
     * dublin core publisher
     * @var array
     */
    public static $DC_PUBLISHER = array(
        'name' => 'DC.publisher',
    );

    /**
     * dublin core subject
     * @var array
     */
    public static $DC_SUBJECT = array(
        'name' => 'DC.subject'
    );

    /**
     * dublin core language
     * @var array
     */
    public static $DC_LANGUAGE = array(
        'name' => 'DC.language'
    );

    /**
     * dublin core title
     * @var array
     */
    public static $DC_TITLE = array(
        'name' => 'DC.title'
    );

    /**
     * dublin core coverage
     * @var array
     */
    public static $DC_COVERAGE = array(
        'name' => 'DC.coverage'
    );

    /**
     * dublin core description
     * @var array
     */
    public static $DC_DESCRIPTION = array(
        'name' => 'DC.description'
    );

    /**
     * dublin core creator
     * @var array
     */
    public static $DC_CREATOR = array(
        'name' => 'DC.creator'
    );

    /**
     * dublin core contributor
     * @var array
     */
    public static $DC_CONTRIBUTOR = array(
        'name' => 'DC.contributor'
    );

    /**
     * dublin core rightsholder
     * @var array
     */
    public static $DC_RIGHTSHOLDER = array(
        'name' => 'DC.rightsHolder'
    );

    /**
     * dublin core rights
     * @var array
     */
    public static $DC_RIGHTS = array(
        'name' => 'DC.rights'
    );

    /**
     * dublin core source
     * @var array
     */
    public static $DC_SOURCE = array(
        'name' => 'DC.source'
    );

    /**
     * dublin core relation
     * @var array
     */
    public static $DC_RELATION = array(
        'name' => 'DC.relation'
    );

    /**
     * dublin core audience
     * @var array
     */
    public static $DC_AUDIENCE = array(
        'name' => 'DC.audience'
    );

    /**
     * dublin core date (format yyyy-mm-dd)
     * @var array
     */
    public static $DC_DATE = array(
        'name' => 'DC.date'
    );

    /**
     * holds meta-information properties
     * @var SplStack
     */
    private $metaProperties;

    /**
     * creates dublin core instance
     */
    public function __construct()
    {
        $this->metaProperties = new \SplStack();
    }

    
}