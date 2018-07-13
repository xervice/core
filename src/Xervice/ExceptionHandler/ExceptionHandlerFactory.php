<?php
declare(strict_types=1);


namespace Xervice\ExceptionHandler;


use Xervice\ExceptionHandler\Business\Handler\DefaultExceptionHandler;
use Xervice\ExceptionHandler\Business\Handler\ExceptionHandlerInterface;
use Xervice\ExceptionHandler\Business\Printer\DebugPrinter;
use Xervice\ExceptionHandler\Business\Printer\ExceptionPrinterInterface;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \Xervice\ExceptionHandler\ExceptionHandlerConfig getConfig()
 */
class ExceptionHandlerFactory extends AbstractFactory
{
    /**
     * @return \Xervice\ExceptionHandler\Business\Handler\DefaultExceptionHandler
     */
    public function createExceptionHandler(): ExceptionHandlerInterface
    {
        return new DefaultExceptionHandler(
            $this->createExceptionPrinter(),
            $this->getConfig()->shutdownIfError()
        );
    }

    /**
     * @return \Xervice\ExceptionHandler\Business\Printer\DebugPrinter
     */
    public function createExceptionPrinter(): ExceptionPrinterInterface
    {
        return new DebugPrinter(
            $this->getConfig()->isDebug()
        );
    }
}