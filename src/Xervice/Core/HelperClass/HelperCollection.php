<?php


namespace Xervice\Core\HelperClass;


class HelperCollection implements \Iterator, \Countable
{
    /**
     * @var \Xervice\Core\HelperClass\HelperInterface[]
     */
    private $collection;

    /**
     * @var int
     */
    private $position;

    /**
     * Collection constructor.
     *
     * @param \Xervice\Core\HelperClass\HelperInterface[] $collection
     */
    public function __construct(array $collection)
    {
        foreach ($collection as $validator) {
            $this->add($validator);
        }
    }

    /**
     * @param \Xervice\Core\HelperClass\HelperInterface $validator
     */
    public function add(HelperInterface $validator): void
    {
        $this->collection[] = $validator;
    }

    /**
     * @return \Xervice\Core\HelperClass\HelperInterface
     */
    public function current(): HelperInterface
    {
        return $this->collection[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->collection[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return \count($this->collection);
    }
}