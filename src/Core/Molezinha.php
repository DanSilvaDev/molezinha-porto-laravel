<?php

namespace Molezinha\Core;

use Apiato\Core\Foundation\Apiato;

class Molezinha extends Apiato
{
    /**
     * Get the containers namespace value from the containers config file
     *
     * @return  string
     */
    public function getContainersNamespace()
    {
        return Config::get('molezinha.containers.namespace');
    }
}
