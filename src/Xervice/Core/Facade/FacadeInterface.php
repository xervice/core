<?php

namespace Xervice\Core\Facade;

use Xervice\Core\Client\ClientInterface;
use Xervice\Core\Config\ConfigInterface;
use Xervice\Core\Factory\FactoryInterface;

interface FacadeInterface
{
    /**
     * @return ConfigInterface
     */
    public function getConfig(): ConfigInterface;

    /**
     * @return FactoryInterface
     */
    public function getFactory(): FactoryInterface;

    /**
     * @return \Xervice\Core\Client\ClientInterface
     */
    public function getClient(): ClientInterface;
}