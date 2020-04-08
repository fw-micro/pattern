<?php

namespace fw\pattern;

/**
 * Class BaseObject
 * @package fw\pattern
 */
abstract class BaseObject
{
    public function __construct(array $config = [])
    {
        foreach ($config as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
