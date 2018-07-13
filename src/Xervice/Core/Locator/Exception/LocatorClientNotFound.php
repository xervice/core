<?php
declare(strict_types=1);


namespace Xervice\Core\Locator\Exception;


use Xervice\Core\Exception\XerviceException;

class LocatorClientNotFound extends XerviceException
{
    /**
     * LocatorFactoryNotFound constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Throwable $previous
     */
    public function __construct(string $message = '', int $code = 0, \Throwable $previous = null)
    {
        $message = 'Client class for service ' . $message . ' not found';
        parent::__construct($message, $code, $previous);
    }

}