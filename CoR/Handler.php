<?php

namespace fw\pattern\CoR;

/**
 * Interface Handler
 * @package fw\pattern\CoR
 */
interface Handler
{
    /**
     * @param Handler $handler
     * @return Handler
     */
    public function setNext(Handler $handler): Handler;

    /**
     * @param $request
     * @return bool
     */
    public function run($request): bool;
}
