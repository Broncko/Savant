<?php
/**
 * Savant Framework / Module Savant (Core)
 *
 * This PHP source file is part of the Savant PHP Framework. It is subject to
 * the Savant License that is bundled with this package in the file LICENSE
 *
 * @category   Savant
 * @package    Savant
 * @subpackage System
 * @author     Hendrik Heinemann <hendrik.heinemann@googlemail.com>
 * @copyright  Copyright (C) 2009-2010 Hendrik Heinemann
 */
namespace Savant\System\Unix;

/**
 * @package System
 * @subpackage Unix
 * exception handling of CProcess
 */
class EProcess extends \Savant\EException {}

/**
 * @package System
 * @subpackage Unix
 * provides unix process handler
 */
class CProcess
{
    /**
     * shared memory variable key
     * @var integer
     */
    const VAR_KEY = 1;

    /**
     * shared memory project resource
     * @var character
     */
    const PROJECT_RESOURCE = 'R';

    /**
     * process lock timeout (seconds)
     * @var integer
     */
    public $TIMEOUT = 30;

    /**
     * maximum amount of processes
     * @var integer
     */
    public $MAX_LOCK = 1;

    /**
     * shared memory key
     * @var resource
     */
    private $shmKey;

    /**
     * semaphore id
     * @var resource
     */
    private $semId;

    /**
     * shared memory id
     * @var resource
     */
    private $shmId;

    /**
     * create process handler instance
     * @param string $pProcessFile process file to lock
     */
    public function __construct($pProcessFile = __FILE__)
    {
        $this->shmKey = \ftok($pProcessFile, self::PROJECT_RESOURCE);
        $this->semId = \sem_get($this->shmKey, $this->MAX_LOCK);
    }

    /**
     * lock process if timeout hasnt expired
     * @param integer $pTimeout set timeout
     */
    public function lock($pTimeout = 0)
    {
        if($pTimeout != 0) $this->TIMEOUT = $pTimeout;
        $locked = \sem_acquire($this->semId);
        $this->shmId = \shm_attach($this->shmKey);
        if($this->isTimedOut())
        {
            throw new EProcess("process ran into timeout");
        }
        else
        {
            \shm_put_var($this->shmId, self::VAR_KEY, time());
        }
    }

    /**
     * return true if process is locked
     * @return boolean
     */
    public function isLocked()
    {
        return $this->isTimedOut();
    }

    /**
     * return true if process has already timed out
     * @return boolean
     */
    private function isTimedOut()
    {
        if(isset($this->shmId) && \shm_has_var($this->shmId, self::VAR_KEY))
        {
            $time = \shm_get_var($this->shmId, self::VAR_KEY);
            return $time > time() - $this->TIMEOUT;
        }
        else
        {
            return false;
        }
    }

    /**
     * unlock process, release attached semaphore
     */
    public function unlock()
    {
        if(isset($this->shmId))
        {
            \shm_detach($this->shmId);
            \sem_release($this->semId);
            \sem_remove($this->semId);
        }
    }

    /**
     * destroy process handler instance, alias of unlock()
     */
    public function __destruct()
    {
        $this->unlock();
    }

    /**
     * create instance of process handler
     * @param string $pProcessFile
     * @return self
     */
    public static function create($pProcessFile)
    {
        return new self($pProcessFile);
    }
}