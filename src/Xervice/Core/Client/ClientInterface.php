<?php


namespace Xervice\Core\Client;


interface ClientInterface
{
    /**
     * @return \Xervice\Core\Config\ConfigInterface
     */
    public function getConfig();
}