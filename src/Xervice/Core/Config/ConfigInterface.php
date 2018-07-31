<?php
declare(strict_types=1);


namespace Xervice\Core\Config;


use Xervice\Core\ServiceClass\XerviceInterface;

interface ConfigInterface extends XerviceInterface
{
    /**
     * @param string $name
     * @param mixed $default
     *
     * @return mixed
     */
    public function get(string $name, $default = null);
}