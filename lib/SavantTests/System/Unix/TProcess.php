<?php
namespace SavantTests\System\Unix;
require_once '/home/broncko/Documents/projects/Savant/savant.php';

class TProcess extends \Savant\ATestCase
{
    const FILENAME = 'lockTest';

    private $obj;

    public function setUp()
    {
        $fh = \fopen(self::FILENAME, 'w');
        $this->obj = \Savant\System\Unix\CProcess::create(self::FILENAME);
        \fclose($fh);
    }

    public function tearDown()
    {
        \unlink(self::FILENAME);
    }

    public function testLock()
    {
        $this->assertTrue(\file_exists(self::FILENAME));
        $this->obj->lock(2);
        $this->assertTrue($this->obj->isLocked());
        $this->obj->unlock();
        $this->assertFalse($this->obj->isLocked());
    }
}