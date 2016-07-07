<?php

/**
 * Created by PhpStorm.
 * User: dhiraj
 * Date: 7/7/16
 * Time: 5:48 AM
 */
//use SimpleLruCache;
require_once ('SimpleLruCache.php');
class SimpleLruCacheTest extends PHPUnit_Framework_TestCase {

    private $__cache;

    /**
     * @param int $size
     * @return SimpleLruCache
     */
    private function __createNode($size = 10) {
        $cache = new SimpleLruCache($size);
        $elements = array();
        for ($i = 1; $i <= $size; $i++) {
            $elements[$i] = 'page no '.$i;
            $cache->enQueue($i, $elements[$i]);
        }
        return $cache;
    }

    public function testContainsKey() {
        $this->__cache = $this->__createNode();
        $this->assertTrue($this->__cache->isInNode(2));
        $this->assertFalse($this->__cache->isInNode(1000));
    }

    public function testReferencePage() {
        $this->__cache = $this->__createNode();
        $this->assertSame("page no 1", $this->__cache->referencePage(1));
        $this->assertSame(null, $this->__cache->referencePage(0));
        $this->assertFalse($this->__cache->referencePage(0, false));
    }

    public function testRemove() {
        $this->__cache = $this->__createNode();
        $this->__cache->deQueue(1);
        $this->assertEquals(1, count($this->__cache));
        $this->assertFalse($this->__cache->isInNode(1));
    }

    public function testDeQueue() {
        $this->__cache = $this->__createNode();
        $this->__cache->enQueue(100, 'new page');
        $this->assertSame('new page', $this->__cache->referencePage(100));
        // now overwrite
        $this->__cache->enQueue(100, 'new page 2');
        $this->assertSame('new page 2', $this->__cache->referencePage(100));
        // now exceed the size limit
        $this->__cache->enQueue(101, 'it is new page');
        $this->assertSame('it is new page', $this->__cache->referencePage(101));
        $this->assertFalse($this->__cache->isInNode(1));
        $this->assertEquals(1, count($this->__cache));
    }

    public function testAccessUpdate() {
        $this->__cache = $this->__createNode();
        // fill cache, access 1st element, and exceed limit
        $this->__cache->enQueue(100, 'new page');
        $this->__cache->referencePage(1);
        $this->__cache->enQueue(101, 'it is new page');
        $this->assertFalse($this->__cache->isInNode(1));
        $this->assertFalse($this->__cache->isInNode(2));
    }

    public function testMakeQueueEmpty() {
        $this->__cache = $this->__createNode();
        $this->__cache->makeQueueEmpty();
        $this->assertFalse($this->__cache->isInNode(1));
    }
}