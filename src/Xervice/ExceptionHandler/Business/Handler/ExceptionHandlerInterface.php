<?php
declare(strict_types=1);


namespace Xervice\ExceptionHandler\Business\Handler;


interface ExceptionHandlerInterface
{
    /**
     * @param \Exception $exception
     * @param bool $isDebug
     */
    public function handleException(\Exception $exception, bool $isDebug): void;
}