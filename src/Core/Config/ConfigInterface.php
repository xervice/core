<?php


namespace Xervice\Core\Config;


interface ConfigInterface
{
    /**
     * @param string $name
     * @param string|null $default
     *
     * @return mixed
     */
    public function get(string $name, string $default = null);
}