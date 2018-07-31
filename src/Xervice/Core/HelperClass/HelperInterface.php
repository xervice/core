<?php


namespace Xervice\Core\HelperClass;


use Xervice\Core\Locator\Proxy\ProxyInterface;
use Xervice\Core\ServiceClass\XerviceInterface;

interface HelperInterface
{
    /**
     * @return string
     */
    public function getMethodName(): string;

    /**
     * @param \Xervice\Core\Locator\Proxy\ProxyInterface $proxy
     *
     * @return \Xervice\Core\ServiceClass\XerviceInterface
     */
    public function getHelper(ProxyInterface $proxy): XerviceInterface;
}