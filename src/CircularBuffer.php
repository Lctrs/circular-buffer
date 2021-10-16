<?php

declare(strict_types=1);

namespace Lctrs\CircularBuffer;

use OverflowException;
use UnderflowException;

/**
 * @template T
 */
final class CircularBuffer
{
    /** @var array<int, T> */
    private $buffer = [];
    /** @var int */
    private $capacity;
    /** @var int */
    private $size = 0;
    /** @var int */
    private $readCursor = 0;
    /** @var int */
    private $writeCursor = -1;

    /**
     * @param positive-int $capacity
     */
    private function __construct(int $capacity)
    {
        $this->capacity = $capacity;
    }

    /**
     * @param positive-int $capacity
     *
     * @return self<T>
     */
    public static function ofCapacity(int $capacity): self
    {
        return new self($capacity);
    }

    /**
     * @param positive-int $capacity
     * @param iterable<V>  $values
     *
     * @return self<V>
     *
     * @template V
     */
    public static function prefilled(int $capacity, iterable $values): self
    {
        $self = new self($capacity);

        foreach ($values as $value) {
            $self->write($value);
        }

        return $self;
    }

    public function isFull(): bool
    {
        return $this->size === $this->capacity;
    }

    public function isEmpty(): bool
    {
        return $this->size === 0;
    }

    /**
     * @param T $element
     */
    public function write($element): void
    {
        if ($this->isFull()) {
            throw new OverflowException('Buffer is full.');
        }

        $this->writeCursor                = ($this->writeCursor + 1) % $this->capacity;
        $this->buffer[$this->writeCursor] = $element;
        $this->size++;
    }

    /**
     * @return T
     */
    public function read()
    {
        if ($this->isEmpty()) {
            throw new UnderflowException('Buffer is empty.');
        }

        try {
            return $this->buffer[$this->readCursor];
        } finally {
            $this->readCursor = ($this->readCursor + 1) % $this->capacity;
            $this->size--;
        }
    }
}
