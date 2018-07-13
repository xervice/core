<?php
declare(strict_types=1);


namespace Xervice\ExceptionHandler\Business\Handler;


use Xervice\ExceptionHandler\Business\Printer\ExceptionPrinterInterface;

class DefaultExceptionHandler implements ExceptionHandlerInterface
{
    /**
     * @var ExceptionPrinterInterface
     */
    private $printer;

    /**
     * @var bool
     */
    private $shutdownIfError;

    /**
     * DefaultExceptionHandler constructor.
     *
     * @param ExceptionPrinterInterface $printer
     * @param bool $shutdownIfError
     */
    public function __construct(
        ExceptionPrinterInterface $printer,
        bool $shutdownIfError
    ) {
        $this->printer = $printer;
        $this->shutdownIfError = $shutdownIfError;
    }

    /**
     * @param \Exception $exception
     */
    public function handleException(\Exception $exception): void
    {
        $this->printer->printExeption($exception);
        $this->shutdownXervicelication();
    }

    protected function shutdownXervicelication(): void
    {
        if ($this->shutdownIfError) {
            exit;
        }
    }
}