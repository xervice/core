<?php


namespace Xervice\Core\Factory;


interface FactoryInterface
{
    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getDependency(string $key);
}