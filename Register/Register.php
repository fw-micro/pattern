<?php

namespace fw\pattern\Register;

use Medoo\Medoo;
use Psr\Log\LoggerInterface;

/**
 * Class Register
 * @package fw\pattern\Register
 *
 * @property string $controller;
 * @property string $action;
 * @property array $request;
 * @property array $response;
 * @property Medoo $db
 * @property array $config
 * @property LoggerInterface|null $logger;
 */
class Register
{
    /**
     * @var LoggerInterface[]
     */
    private $log = [];

    /**
     * @var array
     */
    private $data = [];

    /**
     * @param LoggerInterface $log
     * @return $this
     */
    public function setLog(?LoggerInterface $log): self
    {
        $this->log[] = $log;
        return $this;
    }

    /**
     * @return Register
     */
    public static function get(): Register
    {
        static $instance;

        if ($instance === null) {
            $instance = new static();
        }

        return $instance;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if (empty($this->data[$name])) {
            $this->data[$name] = $value;
            foreach ($this->log as $log) {
                @$log->info('set', ['name' => $name, 'value' => ($value)]);
            }
        }
    }
}
