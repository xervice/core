<?php
declare(strict_types=1);


namespace Xervice\ExceptionHandler\Business\Printer;


class DebugPrinter implements ExceptionPrinterInterface
{
    /**
     * @var bool
     */
    private $isDebug;

    /**
     * DebugPrinter constructor.
     *
     * @param bool $isDebug
     */
    public function __construct(bool $isDebug)
    {
        $this->isDebug = $isDebug;
    }

    /**
     * @param \Exception $exception
     */
    public function printExeption(\Exception $exception): void
    {
        if ($this->isDebug) {
            echo $exception->getMessage() . PHP_EOL;
            echo PHP_EOL;
            echo $exception->getTraceAsString();
        }
    }

}