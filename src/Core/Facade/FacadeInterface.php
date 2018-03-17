<?php


namespace Xervice\Core\Facade;


interface FacadeInterface
{
    /**
     * @return \Xervice\Core\Config\ConfigInterface
     */
    public function getConfig();
}