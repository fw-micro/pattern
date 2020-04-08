<?php

namespace fw_micro\pattern\CoR;

use fw\pattern\BaseObject;
use fw\pattern\Register\Register;
use Psr\Log\LoggerInterface;

/**
 * Class AbstractHandler
 * @package fw\pattern\CoR
 */
abstract class AbstractHandler extends BaseObject implements Handler
{
    /**
     * @var Handler|null
     */
    private $next;

    /**
     * @inheritDoc
     */
    public function setNext(Handler $handler): Handler
    {
        $this->next = $handler;
        return $handler;
    }

    /**
     * @inheritDoc
     */
    public function run($request): bool
    {
        try {
            $status = $this->exec($request);
            if ($status && $this->next) {
                return $this->next->run($request);
            }
        } catch (\Throwable $e) {
            $status = false;
            if ($this->getLogger()) {
                $this->getLogger()->error($e->getMessage(), (new ErrorParser($e))->getData());
            }
        }

        return $status;
    }

    /**
     * @return LoggerInterface|null
     */
    protected function getLogger(): ?LoggerInterface
    {
        return Register::get()->logger;
    }

    /**
     * @param $request
     * @return bool
     */
    abstract public function exec($request): bool;
}
