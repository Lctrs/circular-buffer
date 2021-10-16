<?php

declare(strict_types=1);

namespace Lctrs\CircularBuffer\Test\Unit;

use Lctrs\CircularBuffer\CircularBuffer;
use OverflowException;
use PHPUnit\Framework\TestCase;
use UnderflowException;

final class CircularBufferTest extends TestCase
{
    public function testNewCircularBufferIsEmpty(): void
    {
        $buffer = CircularBuffer::ofCapacity(1);

        self::assertTrue($buffer->isEmpty());
        self::assertFalse($buffer->isFull());
    }

    public function testPrefilled(): void
    {
        $buffer = CircularBuffer::prefilled(3, ['foo', 'bar']);

        self::assertFalse($buffer->isEmpty());
        self::assertFalse($buffer->isFull());
        self::assertSame('foo', $buffer->read());
        self::assertSame('bar', $buffer->read());
    }

    public function testFillingTheBuffer(): void
    {
        $buffer = CircularBuffer::ofCapacity(2);

        $buffer->write('foo');

        self::assertFalse($buffer->isEmpty());
        self::assertFalse($buffer->isFull());

        $buffer->write('bar');

        self::assertFalse($buffer->isEmpty());
        self::assertTrue($buffer->isFull());
    }

    public function testCircularBufferIsAFIFO(): void
    {
        $buffer = CircularBuffer::ofCapacity(2);

        $buffer->write('foo');
        $buffer->write('bar');

        self::assertSame('foo', $buffer->read());

        $buffer->write('baz');

        self::assertSame('bar', $buffer->read());
        self::assertSame('baz', $buffer->read());
    }

    public function testCantWriteToAFullBuffer(): void
    {
        $this->expectException(OverflowException::class);

        $buffer = CircularBuffer::ofCapacity(1);
        $buffer->write('foo');
        $buffer->write('bar');
    }

    public function testCantReadFromAnEmptyBuffer(): void
    {
        $this->expectException(UnderflowException::class);

        $buffer = CircularBuffer::ofCapacity(1);
        $buffer->read();
    }

    public function testReadingFromABufferEmptyIt(): void
    {
        $buffer = CircularBuffer::ofCapacity(1);
        $buffer->write('foo');
        $buffer->read();

        self::assertTrue($buffer->isEmpty());
    }

    public function testCantReadFromAnEmptiedBuffer(): void
    {
        $this->expectException(UnderflowException::class);

        $buffer = CircularBuffer::ofCapacity(1);
        $buffer->write('foo');
        $buffer->read();
        $buffer->read();
    }
}
