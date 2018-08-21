<?php
declare(strict_types=1);

namespace XerviceTest\Core\Business\Dependency;


use Xervice\Core\Business\Model\Dependency\DependencyContainerInterface;
use Xervice\Core\Business\Model\Dependency\Provider\AbstractDependencyProvider;

class DependencyProvider extends AbstractDependencyProvider
{
    /**
     * @param \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface $container
     */
    public function handleDependencies(DependencyContainerInterface $container): void
    {
        $container['TEST'] = function (DependencyContainerInterface $container) {
            return 'TESTING';
        };
    }
}