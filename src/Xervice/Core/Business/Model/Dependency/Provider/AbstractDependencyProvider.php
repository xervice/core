<?php
declare(strict_types=1);

namespace Xervice\Core\Business\Model\Dependency\Provider;


use Xervice\Core\Business\Model\Config\ConfigInterface;

abstract class AbstractDependencyProvider implements DependencyProviderInterface
{
    /**
     * @var \Xervice\Core\Business\Model\Config\ConfigInterface
     */
    protected $config;

    /**
     * AbstractDependencyProvider constructor.
     *
     * @param \Xervice\Core\Business\Model\Config\ConfigInterface $config
     */
    public function __construct(\Xervice\Core\Business\Model\Config\ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * @return \Xervice\Core\Business\Model\Config\ConfigInterface
     */
    protected function getConfig(): ConfigInterface
    {
        return $this->config;
    }
}