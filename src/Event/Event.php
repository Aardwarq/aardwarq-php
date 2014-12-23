<?php

namespace Aardwarq\Api\Event;

abstract class Event implements \JsonSerializable
{
    const TYPE_LOG = 1;
    const TYPE_COUNTER = 2;
    const TYPE_EXCEPTION = 3;
    const TYPE_TIMER = 4;
    const TYPE_MILESTONE = 5;

    protected $type;
    protected $message;
    protected $context;
    protected $environment;
    protected $hostname;
    protected $version;
    protected $createdAt;
    static protected $requestId;

    protected $time = 0.00;
    protected $count = 1;
    protected $stackTrace;
    protected $programmingLanguage;
    
    static protected $defaults = [];

    /**
     * @param string $param
     *
     * @return mixed
     */
    public function getParam($param)
    {
        if (isset($this->$param) && null !== $this->$param) {
            return $this->$param;
        }

        return isset(self::$defaults[$param]) ? self::$defaults[$param] : null;
    }

    /**
     * @param array $defaults
     */
    static public function setDefaults(array $defaults)
    {
        self::$defaults = $defaults;
    }
    
    /**
     * @return int
     * @throws \Exception
     */
    public function getType()
    {
        if (null === $this->type) {
            throw new \Exception('Error while getting type, none is set');
        }

        return $this->type;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->getParam('message');
    }

    /**
     * @param string $message
     *
     * @return Event
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return string
     */
    public function getContext()
    {
        return $this->getParam('context');
    }

    /**
     * @param string $context
     *
     * @return LogMessage
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->getParam('environment');
    }

    /**
     * @param string $environment
     *
     * @return LogMessage
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;

        return $this;
    }

    /**
     * @return string
     */
    public function getHostname()
    {
        if (null === $this->getParam('hostname')) {
            $this->hostname = gethostname();
        }

        return $this->getParam('hostname');
    }

    /**
     * @param string $hostname
     *
     * @return LogMessage
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->getParam('version');
    }

    /**
     * @param string $version
     *
     * @return LogMessage
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        if (null === $this->createdAt) {
            $this->createdAt = new \DateTime();
        }

        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return Event
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getRequestId()
    {
        if (null === self::$requestId && isset(self::$defaults['requestId'])) {
            $this->setRequestId(self::$defaults['requestId']);
        } elseif (null === self::$requestId) {
            $this->setRequestId(uniqid());
        }

        return self::$requestId;
    }

    /**
     * @param string $requestId
     *
     * @return Event
     */
    public function setRequestId($requestId)
    {
        self::$requestId = $requestId;

        return $this;
    }

    /**
     * @return int
     */
    public function getTime()
    {
        return $this->getParam('time');
    }

    /**
     * @param int $time
     *
     * @return Event
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->getParam('count');
    }

    /**
     * @param int $count
     *
     * @return Event
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return array
     */
    public function getStackTrace()
    {
        return $this->getParam('stackTrace');
    }

    /**
     * @param array $stackTrace
     *
     * @return Event
     */
    public function setStackTrace(array $stackTrace)
    {
        $this->stackTrace = $stackTrace;

        return $this;
    }

    /**
     * @return string
     */
    public function getProgrammingLanguage()
    {
        if (null === $this->getParam('programmingLanguage')) {
            $this->programmingLanguage = 'PHP '. phpversion();
        }

        return $this->getParam('programmingLanguage');
    }

    /**
     * @param string $programmingLanguage
     *
     * @return Event
     */
    public function setProgrammingLanguage($programmingLanguage)
    {
        $this->programmingLanguage = $programmingLanguage;

        return $this;
    }

    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return string data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return [
            'type' => $this->getType(),
            'message' => $this->getMessage(),
            'context' => $this->getContext(),
            'request_id' => $this->getRequestId(),
            'time' => $this->getTime(),
            'count' => $this->getCount(),
            'programming_language' => $this->getProgrammingLanguage(),
            'stack_trace' => $this->getStackTrace(),
            'environment' => $this->getEnvironment(),
            'version' => $this->getVersion(),
            'hostname' => $this->getHostname(),
            'created_at' => $this->getCreatedAt()->format('c'),
        ];
    }
}
