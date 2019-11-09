<?php


namespace Seydu\DataGrid;


class ActionList implements \Iterator
{
    /**
     * @var Action[]|array
     */
    private $elements = [];

    /**
     * @var int
     */
    private $position = 0;

    /**
     * @var Action[]|array
     */
    private $values;

    /**
     * ActionList constructor.
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        $this->elements = [];
        foreach ($elements as $element) {
            $this->add($element);
        }
        $this->rewind();
    }

    /**
     * @param Action $element
     * @return $this
     */
    private function add(Action $element)
    {
        $this->elements[$element->getName()] = $element;
        return $this;

    }

    /**
     * Return the current element
     * @link https://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->values[$this->position];
    }

    /**
     * Move forward to next element
     * @link https://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * Return the key of the current element
     * @link https://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Checks if current position is valid
     * @link https://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return isset($this->values[$this->position]);
    }

    /**
     * Rewind the Iterator to the first element
     * @link https://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->position = 0;
        $this->values = \array_values($this->elements);
    }

    /**
     * @return Action[]
     */
    public function toArray()
    {
        $actions = [];
        foreach ($this->elements as $action) {
            $actions[$action->getName()] = $action->getData();
        }
        return $actions;
    }

    public function fromArray(array $actions)
    {
        $list = new self();
        foreach ($actions as $name => $data) {
            $list->add(new Action($name, $data));
        }
        return $list;
    }

}