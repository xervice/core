<?php
declare(strict_types=1);


namespace Xervice\ExceptionHandler;


use Xervice\Core\Facade\AbstractFacade;

/**
 * @method \Xervice\ExceptionHandler\ExceptionHandlerFactory getFactory()
 * @method \Xervice\ExceptionHandler\ExceptionHandlerConfig getConfig()
 */
class ExceptionHandlerFacade extends AbstractFacade
{
    /**
     * @param \Exception $exception
     *
     */
    public function handleException(\Exception $exception): void
    {
        $this->getFactory()->createExceptionHandler()->handleException($exception);
    }
}