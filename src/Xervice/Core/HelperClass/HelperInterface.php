<?php


namespace Xervice\Core\HelperClass;


interface HelperInterface
{
    /**
     * @return string
     */
    public function getMethodName(): string;

    /**
     * @param string $serviceName
     *
     * @return mixed
     */
    public function getHelper(string $serviceName);
}