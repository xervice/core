<?php
declare(strict_types=1);

namespace Xervice\ExceptionHandler;


use Xervice\ExceptionHandler\Business\Handler\DefaultExceptionHandler;
use Xervice\ExceptionHandler\Business\Handler\HandlerCollection;
use Xervice\ExceptionHandler\Business\Handler\HandlerProvider;
use Xervice\ExceptionHandler\Business\Handler\HandlerProviderInterface;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \Xervice\ExceptionHandler\ExceptionHandlerConfig getConfig()
 */
class ExceptionHandlerFactory extends AbstractFactory
{
    /**
     * @return \Xervice\ExceptionHandler\Business\Handler\HandlerProvider
     */
    public function createExceptionHandler(): HandlerProviderInterface
    {
        return new HandlerProvider(
            $this->getExceptionHandlerCollection(),
            $this->getConfig()->isDebug()
        );
    }

    /**
     * @return \Xervice\ExceptionHandler\Business\Handler\HandlerCollection
     */
    public function getExceptionHandlerCollection(): HandlerCollection
    {
        return $this->getDependency(ExceptionHandlerDependencyProvider::EXCEPTION_HANDLER);
    }
}