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

    /**
     * @return \Xervice\Core\Config\ConfigInterface
     */
    public function getConfig();
}