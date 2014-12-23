<?php

namespace Aardwarq\Api\Event;

class Exception extends Event
{
    protected $type = self::TYPE_EXCEPTION;

    /**
     * @param array $stackTrace
     *
     * @return Exception
     */
    public function setStackTrace(array $stackTrace)
    {
        array_walk_recursive($stackTrace, function (&$val) {
            $type = gettype($val);
            switch ($type) {
                case 'object':
                    $val = '[Object] '. get_class($val);
                    break;

                case 'resource':
                    $val = '[Resource]';
                    break;
            }
        });

        $this->stackTrace = $stackTrace;
        return $this->stackTrace;
    }
}