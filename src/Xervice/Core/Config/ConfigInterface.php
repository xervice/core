<?php
declare(strict_types=1);


namespace Xervice\Core\Config;


interface ConfigInterface
{
    /**
     * @param string $name
     * @param mixed $default
     *
     * @return mixed
     */
    public function get(string $name, $default = null);
}