<?php
declare(strict_types=1);


namespace Xervice\ExceptionHandler\Business\Printer;


interface ExceptionPrinterInterface
{
    /**
     * @param \Exception $exception
     */
    public function printExeption(\Exception $exception): void;
}