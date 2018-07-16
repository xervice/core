<?php
declare(strict_types=1);

namespace Xervice\ExceptionHandler\Business\Handler;


class HandlerCollection implements \Iterator, \Countable
{
    /**
     * @var \Xervice\ExceptionHandler\Business\Handler\ExceptionHandlerInterface[]
     */
    private $collection;

    /**
     * @var int
     */
    private $position;

    /**
     * Collection constructor.
     *
     * @param \Xervice\ExceptionHandler\Business\Handler\ExceptionHandlerInterface[] $collection
     */
    public function __construct(array $collection)
    {
        foreach ($collection as $validator) {
            $this->add($validator);
        }
    }

    /**
     * @param \Xervice\ExceptionHandler\Business\Handler\ExceptionHandlerInterface $validator
     */
    public function add(ExceptionHandlerInterface $validator): void
    {
        $this->collection[] = $validator;
    }

    /**
     * @return \Xervice\ExceptionHandler\Business\Handler\ExceptionHandlerInterface
     */
    public function current(): ExceptionHandlerInterface
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