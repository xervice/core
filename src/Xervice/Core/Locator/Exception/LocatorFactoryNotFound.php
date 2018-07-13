<?php
declare(strict_types=1);


namespace Xervice\Core\Locator\Exception;


use Xervice\Core\Exception\XerviceException;

class LocatorFactoryNotFound extends XerviceException
{
    /**
     * LocatorFactoryNotFound constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(string $message = '', int $code = 0, \Throwable $previous = null)
    {
        $message = 'Factory class for service ' . $message . ' not found';
        parent::__construct($message, $code, $previous);
    }
}
