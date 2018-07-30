<?php


namespace Xervice\Core;


use Xervice\Core\Factory\AbstractFactory;
use Xervice\Core\Locator\Proxy\ProxyInterface;
use Xervice\Core\Locator\Proxy\XerviceLocatorProxy;

class CoreFactory extends AbstractFactory
{
    /**
     * @param string $service
     * @param string $projectNamespace
     * @param array $additionalNamespaces
     *
     * @return \Xervice\Core\Locator\Proxy\ProxyInterface
     */
    public function createXerviceLocatorProxy(string $service, string $projectNamespace, array $additionalNamespaces): ProxyInterface
    {
        return new XerviceLocatorProxy(
            $service,
            $projectNamespace,
            $additionalNamespaces
        );
    }
}