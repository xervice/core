<?php


namespace XerviceTest\Core\Locator\Helper;


use Xervice\Core\HelperClass\HelperInterface;

class TestHelper implements HelperInterface
{
    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return 'myTest';
    }

    /**
     * @return mixed|string
     */
    public function getHelper(string $serviceName): string
    {
        return $serviceName;
    }

}