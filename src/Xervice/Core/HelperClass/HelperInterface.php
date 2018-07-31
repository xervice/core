<?php


namespace Xervice\Core\HelperClass;


interface HelperInterface
{
    /**
     * @return string
     */
    public function getMethodName(): string;

    /**
     * @return mixed
     */
    public function getHelper();
}