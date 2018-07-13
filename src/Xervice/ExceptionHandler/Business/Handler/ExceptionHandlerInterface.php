<?php
declare(strict_types=1);


namespace Xervice\ExceptionHandler\Business\Handler;


interface ExceptionHandlerInterface
{
    /**
     * @param \Exception $exception
     */
    public function handleException(\Exception $exception): void;
}