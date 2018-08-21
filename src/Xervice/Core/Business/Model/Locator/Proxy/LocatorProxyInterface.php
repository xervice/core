<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Locator\Proxy;


use Xervice\Core\Business\Model\Locator\Proxy\Business\BusinessLocatorProxyInterface;
use Xervice\Core\Business\Model\Locator\Proxy\Communication\CommunicationLocatorProxyInterface;
use Xervice\Core\Business\Model\Locator\Proxy\Persistence\PersistenceLocatorProxyInterface;

interface LocatorProxyInterface
{
    /**
     * @return string
     */
    public function name(): string;

    /**
     * @return \Xervice\Core\Business\Model\Locator\Proxy\Business\BusinessLocatorProxy
     */
    public function businessLocator(): BusinessLocatorProxyInterface;

    /**
     * @return \Xervice\Core\Business\Model\Locator\Proxy\Communication\CommunicationLocatorProxy
     */
    public function communicationLocator(): CommunicationLocatorProxyInterface;

    /**
     * @return \Xervice\Core\Business\Model\Locator\Proxy\Persistence\PersistenceLocatorProxy
     */
    public function persistenceLocator(): PersistenceLocatorProxyInterface;
}