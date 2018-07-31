<?php


namespace Xervice\Core;


use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;
use Xervice\Core\HelperClass\HelperCollection;

class CoreDependencyProvider extends AbstractProvider
{
    public const CLASS_PROVIDER_COLLECTION = 'class.provider.collection';

    public function handleDependencies(DependencyProviderInterface $dependencyProvider): void
    {
        $dependencyProvider[self::CLASS_PROVIDER_COLLECTION] = function () {
            return new HelperCollection(
                $this->getHelper()
            );
        };
    }

    /**
     * @return \Xervice\Core\HelperClass\HelperInterface[]
     */
    protected function getHelper(): array
    {
        return [];
    }
}