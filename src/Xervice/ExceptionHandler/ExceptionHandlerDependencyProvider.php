<?php
declare(strict_types=1);

namespace Xervice\ExceptionHandler;


use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;
use Xervice\ExceptionHandler\Business\Handler\HandlerCollection;

class ExceptionHandlerDependencyProvider extends AbstractProvider
{
    public const EXCEPTION_HANDLER = 'exception.handler';

    public function handleDependencies(DependencyProviderInterface $dependencyProvider): void
    {
        $dependencyProvider[self::EXCEPTION_HANDLER] = function () {
            return new HandlerCollection(
                $this->getExceptionHandler()
            );
        };
    }

    /**
     * @return \Xervice\ExceptionHandler\Business\Handler\ExceptionHandlerInterface[]
     */
    public function getExceptionHandler(): array
    {
        return [];
    }
}
