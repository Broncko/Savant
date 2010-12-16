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
 */
namespace Savant\Template;
require_once \Savant\CBootstrap::$EXT_DIR . \DIRECTORY_SEPARATOR . 'jpgraph' . \DIRECTORY_SEPARATOR . 'src'. \DIRECTORY_SEPARATOR . 'jpgraph.php';

/**
 * @package Savant
 * @subpackage Template
 * exception handling of CJpGraph
 */
class EJpGraph extends \Savant\EException {}

/**
 * @package Savant
 * @subpackage Template
 * wrapper of the extension JpGraph
 */
class CJpGraph extends AEngine implements IEngine
{
    /**
     * template suffix
     * @var string
     */
    const SUFFIX = '.jpgraph.php';

    /**
     * plot type line
     * @var string
     */
    const PT_LINE = 'lineplot';

    /**
     * plot type area
     * @var string
     */
    const PT_AREA = 'areaplot';

    /**
     * plot type bar
     * @var string
     */
    const PT_BAR = 'barplot';

    /**
     * plot type field
     * @var string
     */
    const PT_FIELD = 'fieldplot';

    /**
     * plot type error
     * @var string
     */
    const PT_ERROR = 'errorplot';

    /**
     * plot type stock
     * @var string
     */
    const PT_STOCK = 'stockplot';

    /**
     * plot type geomap
     * @var string
     */
    const PT_MAP = 'geomapplot';

    /**
     * plot type impuls
     * @var string
     */
    const PT_IMPULS = 'impulsplot';

    /**
     * plot type spline
     * @var string
     */
    const PT_SPLINE = 'splineplot';

    /**
     * plot type balloon
     * @var string
     */
    const PT_BALLOON = 'balloon_plot';

    /**
     * plot type scatter
     * @scatter
     */
    const PT_SCATTER = 'scatterplot';

    /**
     * plot type contour
     * @var string
     */
    const PT_CONTOUR = 'contourplot';

    /**
     * plot type piechart
     * @var string
     */
    const PT_PIE = 'pieplot';

    /**
     * graph type line
     * @var string
     */
    const GT_LINE = 'linetype';

    /**
     * graph type bar
     * @var string
     */
    const GT_BAR = 'bartype';

    /**
     * graph type error
     * @var string
     */
    const GT_ERROR = 'errortype';

    /**
     * graph type stock
     * @var string
     */
    const GT_STOCK = 'stocktype';

    /**
     * graph type scatter
     * @var string
     */
    const GT_SCATTER = 'scattertype';

    /**
     * graph type contour
     * @var string
     */
    const GT_CONTOUR = 'contourtype';

    /**
     * graph type piechart
     * @var string
     */
    const GT_PIE = 'pietype';

    /**
     * graph dir
     * @var string
     */
    public static $JPGRAPH_DIR;

    /**
     * graph width
     * @var integer
     */
    public static $WIDTH = 400;

    /**
     * graph height
     * @var integer
     */
    public static $HEIGHT = 300;

    /**
     * graph title
     * @var string
     */
    public static $TITLE;
    
    /**
     * graph subtitle
     * @var string
     */
    public static $SUBTITLE;

    /**
     * graph margins
     * @var array
     */
    public static $MARGIN;

    /**
     * graph types
     * @var array
     */
    private static $GRAPH_TYPES = array(
        self::PT_AREA => self::GT_LINE,
        self::PT_LINE => self::GT_LINE,
        self::PT_BAR => self::GT_BAR,
        self::PT_CONTOUR => self::GT_CONTOUR,
        self::PT_ERROR => self::GT_ERROR,
        self::PT_STOCK => self::GT_STOCK,
        self::PT_BALLOON => self::GT_SCATTER,
        self::PT_FIELD => self::GT_SCATTER,
        self::PT_IMPULS => self::GT_SCATTER,
        self::PT_MAP => self::GT_SCATTER,
        self::PT_SCATTER => self::GT_SCATTER,
        self::PT_SPLINE => self::GT_SCATTER,
        self::PT_PIE => self::GT_PIE
    );

    /**
     * graph files
     * @var array
     */
    private static $GRAPH_FILES = array(
        self::GT_LINE => 'jpgraph_line.php',
        self::GT_BAR => 'jpgraph_bar.php',
        self::GT_CONTOUR => 'jpgraph_contour.php',
        self::GT_ERROR => 'jpgraph_error.php',
        self::GT_STOCK => 'jpgraph_stock.php',
        self::GT_SCATTER => 'jpgraph_scatter.php',
        self::GT_PIE => 'jpgraph_pie.php'
    );

    /**
     * jpgraph graph object
     * @var object
     */
    private $graph;

    /**
     * graph plots
     * @var array
     */
    private $plots;

    /**
     * x-axis data
     * @var array
     */
    private $dataX;

    /**
     * y-axis data
     * @var array
     */
    private $dataY;

    /**
     * create graph renderer instance
     * @param string $pSection
     */
    public function __construct($pSection = 'default')
    {
        parent::__construct($pSection);
        self::$JPGRAPH_DIR = \Savant\CBootstrap::$EXT_DIR . \DIRECTORY_SEPARATOR . 'jpgraph' . \DIRECTORY_SEPARATOR . 'src';
        $this->graph = new \Graph(self::$WIDTH, self::$HEIGHT);
    }

    /**
     * set graph properties
     */
    public function setProperties()
    {
        $this->graph->title->Set(self::$TITLE);
    }

    /**
     * add plot to graph
     * @param string $pType plot types self::PT_*
     * @param array $pOptions plot options
     * @param boolean $pAdd if false, return plot instead of adding to graph
     * @return object plot, if not rendered directly
     */
    public function addPlot($pType = self::PT_LINE, $pOptions = array(), $pAdd = true)
    {
        $file = self::$JPGRAPH_DIR . \DIRECTORY_SEPARATOR . self::$GRAPH_FILES[self::$GRAPH_TYPES[$pType]];
        if(\file_exists($file))
        {
            require_once $file;
        }
        if(!(count($this->dataX) > 0))
        {
            $this->dataX = false;
        }
        switch($pType)
        {
            case self::PT_LINE:
                $plot = new \LinePlot($this->dataY, $this->dataX);
                break;
            case self::PT_AREA:
                $plot = new \LinePlot($this->dataY, $this->dataX);
                if(\array_key_exists('color', $pOptions))
                {
                    $plot->SetFillColor($pOptions['color']);
                }
                break;
            case self::PT_BAR:
                $plot = new \BarPlot($this->dataY, $this->dataX);
                break;
            case self::PT_ERROR:
                $plot = new \ErrorPlot($this->dataY, $this->dataY);
                break;
            case self::PT_FIELD:
                $plot = new \FieldPlot($this->dataY, $this->dataX);
                break;
            case self::PT_STOCK:
                $plot = new \StockPlot($this->dataY, $this->dataX);
                break;
            case self::PT_SCATTER:
                $plot = new \ScatterPlot($this->dataY, $this->dataX);
                break;
            case self::PT_BALLOON:
                $plot = new \ScatterPlot($this->dataY, $this->dataX);
                break;
            case self::PT_IMPULS:
                $plot = new \ScatterPlot($this->dataY, $this->dataX);
                $plot->SetImpuls();
                break;
            case self::PT_PIE:
                $this->graph = new \PieGraph(self::$WIDTH, self::$HEIGHT);
                $plot = new \PiePlot($this->data);
                break;
        }
        if($pAdd)
        {
            $this->plots[] = $plot;
            $this->graph->Add($plot);
        }
        else
        {
            return $plot;
        }
    }

    /**
     * render graph
     * @param boolean $pDisplay
     * @return object return graph object instead of stroking, if $pDisplay ist
     * set to true
     */
    public function _render($pDisplay = true)
    {
        if($pDisplay)
        {
            $this->graph->Stroke();
        }
        else
        {
            return $this->graph->Stroke();
        }
    }

    /**
     * assign data
     * @param array $data
     */
    public function _assign(\Savant\Storage\CValueObject $pData)
    {
        $this->graph->SetScale('intlin');
        $this->dataX = $pData->data['x'];
        $this->dataY = $pData->data['y'];
    }

    /**
     * ensure that expression is true
     * @param mixed $pExpr
     * @param string $pMesg
     */
    private function ensure($pExpr, $pMesg = null)
    {
        if(!$pExpr)
        {
            if($pMesg != null)
            {
                throw new EJpGraph($pMesg);
            }
        }
    }
}
