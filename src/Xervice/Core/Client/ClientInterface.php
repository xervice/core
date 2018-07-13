<?php
declare(strict_types=1);


namespace Xervice\Core\Client;


use Xervice\Core\Config\ConfigInterface;

interface ClientInterface
{
    /**
     * @return \Xervice\Core\Config\ConfigInterface
     */
    public function getConfig(): ConfigInterface;
}