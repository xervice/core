<?php
declare(strict_types=1);


namespace Xervice\Core\Dependency\Provider;


use Xervice\Core\Dependency\DependencyProviderInterface;

class EmptyProvider extends AbstractProvider
{
    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     */
    public function handleDependencies(DependencyProviderInterface $dependencyProvider): void
    {
    }
}
