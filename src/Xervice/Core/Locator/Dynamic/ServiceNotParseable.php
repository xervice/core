<?php


namespace Core\Locator\Dynamic;


use Xervice\Core\Exception\XerviceException;

class ServiceNotParseable extends XerviceException
{
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null)
    {
        $message = 'Service class not parseable from namespace: ' . $message;
        parent::__construct($message, $code, $previous);
    }

}