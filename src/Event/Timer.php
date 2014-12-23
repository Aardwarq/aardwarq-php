<?php

namespace Aardwarq\Api\Event;

class Timer extends Event
{
    protected $type = self::TYPE_TIMER;

    protected $start;
    protected $stop;

    /**
     * @return Timer
     */
    public function start()
    {
        $this->start = microtime(true);

        return $this;
    }

    /**
     * @return Timer
     */
    public function stop()
    {
        $this->stop = microtime(true);

        return $this;
    }

    /**
     * Get difference of start and stop, stops the timer
     * @return float
     */
    public function getTime()
    {
        if (null === $this->stop) {
            $this->stop();
        }

        return $this->stop - $this->start;
    }

}
