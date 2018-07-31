<?php


namespace Xervice\Core\HelperClass;


use Xervice\Core\Locator\Proxy\ProxyInterface;

interface HelperInterface
{
    /**
     * @return string
     */
    public function getMethodName(): string;

    /**
     * @param \Xervice\Core\Locator\Proxy\ProxyInterface $proxy
     *
     * @return mixed
     */
    public function getHelper(ProxyInterface $proxy);
}