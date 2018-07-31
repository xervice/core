<?php
declare(strict_types=1);


namespace Xervice\Core\Client;


use Xervice\Core\Config\ConfigInterface;
use Xervice\Core\ServiceClass\XerviceInterface;

interface ClientInterface extends XerviceInterface
{
    /**
     * @return \Xervice\Core\Config\ConfigInterface
     */
    public function getConfig(): ConfigInterface;
}