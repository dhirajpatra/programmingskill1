<?php

/**
 * Created by PhpStorm.
 * User: dhiraj
 * Date: 6/7/16
 * Time: 9:57 PM
 */
class SimpleLruCache
{
    /**
     * max_size for pages in node
     * @var int
     */
    protected $__maxSize;

    /**
     * The array contains the LRU pages
     *
     * @var array
     */
    protected $__qNode = array();

    /**
     * Create a LRU Cache Node
     *
     * @param int $size default 100
     */
    public function __construct($size = 100) {
        if($size > 0 && $size <= 100){
            $this->__maxSize = (int)$size;
        }
    }

    /**
     * Insert page in the cache node
     *
     * @param int|string $key   The key of node
     * @param mixed      $value The value to cache node
     */
    public function enQueue($key, $value) {
        if (isset($this->__qNode[$key])) {
            $this->__qNode[$key] = $value;
            // move page to actual position in node
            $this->__movePage($key);
        } else {
            $this->__qNode[$key] = $value;
            if (count($this->__qNode) > $this->__maxSize) {
                // remove least recently used page from top of the queue node
                reset($this->__qNode);
                unset($this->__qNode[key($this->__qNode)]);
            }
        }
    }

    /**
     * Remove the page from queue node of this key.
     *
     * @param int|string $key The key
     * @return mixed Value or null if not set
     */
    public function deQueue($key) {
        if (isset($this->__qNode[$key])) {
            $value = $this->__qNode[$key];
            unset($this->__qNode[$key]);
            return $value;
        } else {
            return null;
        }
    }

    /**
     * Get the page from cached node of this key
     *
     * @param int $key     The key.
     * @param mixed      $default The value to be returned if key not found
     * @return mixed
     */
    public function referencePage($key, $default = null) {
        if (isset($this->__qNode[$key])) {
            $this->__movePage($key);
            return $this->__qNode[$key];
        } else {
            return $default;
        }
    }

    /**
     * Moves a page from current position to end of node
     *
     * @param int|string $key The key
     */
    private function __movePage($key) {
        $value = $this->__qNode[$key];
        unset($this->__qNode[$key]);
        $this->__qNode[$key] = $value;
    }

    /**
     * Check if the node contain a page with this key
     *
     * @param int|string $key The key
     * @return boolean
     */
    public function isInNode($key) {
        return isset($this->__qNode[$key]);
    }

    /**
     * Empty the node
     */
    public function makeQueueEmpty() {
        $this->__qNode = array();
    }

}