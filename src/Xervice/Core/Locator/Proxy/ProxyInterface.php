<?php

namespace Xervice\Core\Locator\Proxy;

use Xervice\Core\Client\ClientInterface;
use Xervice\Core\Config\ConfigInterface;
use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Facade\FacadeInterface;
use Xervice\Core\Factory\FactoryInterface;

interface ProxyInterface
{
    /**
     * @return \Xervice\Core\Config\ConfigInterface
     */
    public function config(): ConfigInterface;

    /**
     * @return \Xervice\Core\Factory\FactoryInterface
     */
    public function factory(): FactoryInterface;

    /**
     * @return \Xervice\Core\Facade\FacadeInterface
     */
    public function facade(): FacadeInterface;

    /**
     * @return \Xervice\Core\Client\ClientInterface
     */
    public function client(): ClientInterface;

    /**
     * @return \Xervice\Core\Dependency\DependencyProviderInterface
     */
    public function container(): DependencyProviderInterface;

    /**
     * @param string $type
     *
     * @return array
     */
    public function getServiceNamespaces(string $type): array;

    /**
     * @return string
     */
    public function getServiceName(): string;
}