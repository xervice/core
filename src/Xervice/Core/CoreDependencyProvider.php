<?php
declare(strict_types=1);

namespace Xervice\Core;


use Xervice\Core\Business\Model\Dependency\DependencyContainerInterface;
use Xervice\Core\Business\Model\Dependency\Provider\DependencyProviderInterface;

class CoreDependencyProvider implements DependencyProviderInterface
{
    /**
     * @param \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface $container
     */
    public function handleDependencies(DependencyContainerInterface $container): void
    {
        // TODO: Implement handleDependencies() method.
    }
}
