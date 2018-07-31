<?php
declare(strict_types=1);

namespace Xervice\Core\Facade;

use Xervice\Core\Client\ClientInterface;
use Xervice\Core\Config\ConfigInterface;
use Xervice\Core\Factory\FactoryInterface;
use Xervice\Core\ServiceClass\XerviceInterface;

interface FacadeInterface extends XerviceInterface
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