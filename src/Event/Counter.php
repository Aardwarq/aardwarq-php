<?php

namespace Aardwarq\Api\Event;

class Counter extends Event
{
    protected $type = self::TYPE_COUNTER;
    protected $count = 0;

    /**
     * @return Counter
     */
    public function increment()
    {
        $this->count++;

        return $this;
    }

    /**
     * @return Counter
     */
    public function decrement()
    {
        $this->count--;

        return $this;
    }

}