<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Locator\Proxy;


use Xervice\Core\Business\Model\Locator\Proxy\Business\BusinessLocatorProxy;

interface LocatorProxyInterface
{
    /**
     * @return string
     */
    public function name(): string;
}