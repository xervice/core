<?php
declare(strict_types=1);

namespace XerviceTest\Core\Business\Dependency;


use Xervice\Core\Business\Model\Dependency\DependencyContainerInterface;
use Xervice\Core\Business\Model\Dependency\Provider\AbstractDependencyProvider;

class DependencyProvider extends AbstractDependencyProvider
{
    /**
     * @param \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface $container
     *
     * @return \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface
     */
    public function handleDependencies(DependencyContainerInterface $container): DependencyContainerInterface
    {
        $container['TEST'] = function (DependencyContainerInterface $container) {
            $facade = $container->getLocator()->core()->facade();
            $config = $container->getConfig();
            return 'TESTING';
        };

        return $container;
    }
}